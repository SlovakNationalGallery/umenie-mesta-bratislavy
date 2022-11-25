<?php

namespace App\Jobs;

use App\Models\Artwork;
use App\Models\Author;
use App\Models\Keyword;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Year;
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
                'keywords' => 'fldra8AriumQ5s7j7',
                'locations' => 'fldGr3FprjBwznUPD',
                'years' => 'fldxCrnyBQOhsqRXv',
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
        'keywords' => [
            'id' => 'tblb8KV9fHEP1HSiq',
            'fields' => [
                'keyword' => 'fldq0bX5qdYxGj2v1',
            ],
        ],
        'locations' => [
            'id' => 'tbl07Ra5HNp9XQnUL',
            'fields' => [
                'address' => 'fldqcO0CRqUN5qH3t',
                'postal_code' => 'fldzSGWB2hjBo56cs',
                'district' => 'fldiFyzXnZEglcyTm',
                'borough' => 'fld35CIDrs7EteVLs',
                'plot' => 'fldHh4AY6wlDz5YWD',
                'description' => 'fldN1WHmHFc4bauIW',
                'gps_lon' => 'fld0WizNrlIkCytHO',
                'gps_lat' => 'fldt1nvc3bN1sKU3r',
                'is_current' => 'fld0WqONl2LalL9Ge',
            ],
        ],
        'years' => [
            'id' => 'tbljEwk8Rdf4wLzzA',
            'fields' => [
                'earliest' => 'fldz9DplXEJyOCvlk',
                'latest' => 'fldJ5uM3QSS6Cwlrw',
                'description' => 'fldAZcKpbmoWF36LP',
                'type' => 'fldxvXBDVHRpCYyga',
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
        $keywords = $this->listRecords('keywords')->collect();
        $locations = $this->listRecords('locations')->collect();
        $photos = $this->listRecords('photos')->collect();
        $years = $this->listRecords('years')->collect();

        DB::transaction(function () use (
            $artworks,
            $authors,
            $keywords,
            $locations,
            $photos,
            $years
        ) {
            DB::table('artwork_author')->delete();
            DB::table('artwork_keyword')->delete();
            DB::table('artwork_location')->delete();
            DB::table('artwork_photo')->delete();
            DB::table('artwork_year')->delete();
            Author::whereNotIn('id', $authors->pluck('id'))->delete();
            Location::whereNotIn('id', $locations->pluck('id'))->delete();
            Photo::whereNotIn('id', $photos->pluck('id'))->delete();
            Year::whereNotIn('id', $years->pluck('id'))->delete();
            Artwork::whereNotIn('id', $artworks->pluck('id'))->delete();

            $authors
                ->chunk(100)
                ->each(fn($chunk) => Author::upsert($chunk->toArray(), ['id']));

            $keywords
                ->chunk(100)
                ->each(
                    fn($chunk) => Keyword::upsert($chunk->toArray(), ['id'])
                );

            $locations
                ->chunk(100)
                ->each(
                    fn($chunk) => Location::upsert($chunk->toArray(), ['id'])
                );

            $photos
                ->chunk(100)
                ->each(
                    fn($photos) => Photo::upsert(
                        $photos->map->except(['media'])->toArray(),
                        ['id']
                    )
                );

            $years
                ->chunk(100)
                ->each(fn($chunk) => Year::upsert($chunk->toArray(), ['id']));

            $artworks->chunk(100)->each(function ($artworks) {
                Artwork::upsert(
                    $artworks->map
                        ->except([
                            'authors',
                            'coauthors',
                            'keywords',
                            'locations',
                            'photos',
                            'years',
                        ])
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

                DB::table('artwork_keyword')->insert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['keywords'])->map(
                                fn($author_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'keyword_id' => $author_id,
                                    'order' => $index,
                                ]
                            )
                        )
                        ->toArray()
                );

                DB::table('artwork_location')->insert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['locations'])->map(
                                fn($author_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'location_id' => $author_id,
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

                DB::table('artwork_year')->insert(
                    $artworks
                        ->flatMap(
                            fn($artwork) => collect($artwork['years'])->map(
                                fn($year_id, $index) => [
                                    'artwork_id' => $artwork['id'],
                                    'year_id' => $year_id,
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
