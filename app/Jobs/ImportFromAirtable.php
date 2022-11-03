<?php

namespace App\Jobs;

use App\Models\Artwork;
use App\Models\ArtworkAuthor;
use App\Models\Author;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\LazyCollection;

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

        DB::transaction(function () use ($artworks, $authors) {
            DB::table('artwork_author')->delete();
            Artwork::whereNotIn('id', $artworks->pluck('id'))->delete();
            Author::whereNotIn('id', $authors->pluck('id'))->delete();

            $authors
                ->chunk(100)
                ->each(
                    fn($authors) => Author::upsert($authors->toArray(), ['id'])
                );

            $artworks->chunk(100)->each(function ($artworks) {
                Artwork::upsert(
                    $artworks->map->except(['authors', 'coauthors'])->toArray(),
                    ['id']
                );

                // Authors
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

                // Co-authors
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
