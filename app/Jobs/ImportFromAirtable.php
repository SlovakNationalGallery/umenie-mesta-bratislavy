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
            DB::table('artwork_author')->delete();
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
                DB::table('artwork_author')->insert(
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
                        ->toArray()
                );

                DB::table('artwork_author')->insert(
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
                        ->toArray()
                );

                DB::table('artwork_photo')->insert(
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
                        ->toArray()
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

        $importedAirtableIds = Media::pluck('custom_properties')->pluck([
            'airtable_id',
        ]);

        $unimportedAirtableIds = $upstreamMediaAirtableIds->diff(
            $importedAirtableIds
        );

        if ($unimportedAirtableIds->isNotEmpty()) {
            $photos->each(function ($photo) use ($unimportedAirtableIds) {
                collect($photo['media'])->each(function ($media) use (
                    $unimportedAirtableIds,
                    $photo
                ) {
                    if ($unimportedAirtableIds->doesntContain($media['id'])) {
                        return;
                    }

                    // TODO move to a separate job
                    Photo::find($photo['id'])
                        ->addMediaFromUrl($media['url'])
                        ->withCustomProperties(['airtable_id' => $media['id']])
                        ->usingFilename($media['filename'])
                        ->toMediaCollection();
                });
            });
        }
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
