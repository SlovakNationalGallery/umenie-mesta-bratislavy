<?php

namespace App\Jobs;

use App\Models\Artwork;
use App\Models\Author;
use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\LazyCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportFromAirtable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected static $tables = [
        'artworks' => [
            'id' => 'tblsQiI0KYuaDvPZ5',
            'fields' => [
                'name' => 'fldIL8binV6omIxcP',
                'authors' => 'fld6JFDyetXLQTFXK',
                'coauthors' => 'fldr8pojoo7MoDwHs',
                'photos' => 'fldNn5tr9pq8VBxnu',
            ],
        ],
        'authors' => [
            'id' => 'tblHP9KjS2B5pzsm5',
            'fields' => [
                'first_name' => 'fldLxr7puFcJ8rFmk',
                'last_name' => 'fld75ZIsJi1VIuB5S',
                'other_name' => 'fldAKxihfS6r6OqHv',
            ],
        ],
        'photos' => [
            'id' => 'tbl8P5wGh0p4tYMQL',
            'fields' => [
                'description' => 'fldNBjZxPtG0Ib7er',
                'media' => 'fld2TGDfLmdo3YcAS',
            ],
        ],
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $artworks = $this->listRecords('artworks')->collect();
        $authors = $this->listRecords('authors')->collect();
        $photos = $this->listRecords('photos')->collect();

        DB::transaction(function () use ($artworks, $authors, $photos) {
            Artwork::whereNotIn('id', $artworks->pluck('id'))->delete();
            Author::whereNotIn('id', $authors->pluck('id'))->delete();
            Photo::whereNotIn('id', $photos->pluck('id'))->delete();

            $photos
                ->chunk(100)
                ->each(
                    fn($photos) => Photo::upsert(
                        $photos->map->except(['media'])->toArray(),
                        ['id']
                    )
                );

            $authors
                ->chunk(100)
                ->each(
                    fn($authors) => Author::upsert($authors->toArray(), ['id'])
                );

            $artworks->chunk(100)->each(function ($artworks) {
                Artwork::upsert(
                    $artworks->map
                        ->except(['authors', 'coauthors', 'photos'])
                        ->toArray(),
                    ['id']
                );

                // Relationships
                DB::table('artwork_author')->upsert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['authors'])->map(
                                fn($author_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'author_id' => $author_id,
                                    'role' => 'author',
                                    'order' => $index,
                                ]
                            )
                        )
                        ->toArray(),
                    ['artwork_id', 'author_id', 'role'],
                    ['order']
                );

                DB::table('artwork_author')->upsert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['coauthors'])->map(
                                fn($author_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'author_id' => $author_id,
                                    'role' => 'coauthor',
                                    'order' => $index,
                                ]
                            )
                        )
                        ->toArray(),
                    ['artwork_id', 'author_id', 'role'],
                    ['order']
                );
                DB::table('artwork_photo')->upsert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['photos'])->map(
                                fn($photo_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'photo_id' => $photo_id,
                                    'order' => $index,
                                ]
                            )
                        )
                        ->toArray(),
                    ['artwork_id', 'photo_id'],
                    ['order']
                );
            });
        });

        // Photo media (Airtable attachments)
        $upstreamMediaAirtableIds = $photos
            ->flatMap(fn($p) => $p['media'])
            ->pluck('id');

        // Cleanup media no longer in upstream
        Media::destroy(
            Media::whereNotIn(
                'custom_properties->airtable_id',
                $upstreamMediaAirtableIds
            )->pluck('id')
        );

        $photos->each(function ($upstreamPhoto) {
            $photo = Photo::find($upstreamPhoto['id']);
            $importedAirtableIds = $photo
                ->media()
                ->pluck('custom_properties')
                ->pluck(['airtable_id']);

            $upstreamAirtableIds = collect($upstreamPhoto['media'])->pluck(
                'id'
            );

            if ($importedAirtableIds == $upstreamAirtableIds) {
                return;
            }

            // Sorting
            $upstreamAirtableIds->each(function ($airtableId, $index) use (
                $photo
            ) {
                $photo
                    ->media()
                    ->where('custom_properties->airtable_id', $airtableId)
                    ->update([
                        'order_column' => $index + 1, // medialibrary sorts from 1 by default
                    ]);
            });

            // Inserts
            $unimportedAirtableIds = $upstreamAirtableIds->diff(
                $importedAirtableIds
            );

            $unimportedAirtableIds->each(function ($airtableId) use (
                $photo,
                $upstreamPhoto
            ) {
                $upstreamMedia = collect($upstreamPhoto['media'])->firstOrFail(
                    fn($m) => $m['id'] == $airtableId
                );

                $photo
                    ->addMediaFromUrl($upstreamMedia['url'])
                    ->withCustomProperties([
                        'airtable_id' => $upstreamMedia['id'],
                    ])
                    ->withResponsiveImages()
                    ->toMediaCollection();
            });
        });
    }

    private function listRecords(string $tableName)
    {
        $url = sprintf(
            'https://api.airtable.com/v0/%s/%s',
            config('services.airtable.base'),
            self::$tables[$tableName]['id']
        );

        return LazyCollection::make(function () use ($url) {
            $offset = null;

            do {
                $response = Http::withToken(
                    config('services.airtable.api_key')
                )->get($url, [
                    'offset' => $offset,
                    'returnFieldsByFieldId' => true,
                ]);

                $offset = $response->json('offset');

                yield from $response->collect('records');
            } while ($offset);
        })->map(function ($record) use ($tableName) {
            $mappedFields = collect(self::$tables[$tableName]['fields'])->map(
                fn($fieldId) => Arr::get($record, "fields.$fieldId")
            );

            return collect(['id' => $record['id'], ...$mappedFields]);
        });
    }
}
