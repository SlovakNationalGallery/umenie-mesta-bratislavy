<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Location extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    public $incrementing = false;
    protected $keyType = 'string';

    public static function getBoroughs()
    {
        return [
            'Staré Mesto' => [
                'district' => 'Bratislava I',
                'district_short' => 'I',
            ],
            'Ružinov' => [
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Vrakuňa' => [
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Podunajské Biskupice' => [
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Nové Mesto' => [
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Rača' => [
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Vajnory' => [
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Karlova Ves' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Dúbravka' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Lamač' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Devín' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Devínska Nová Ves' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Záhorská Bystrica' => [
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Petržalka' => [
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Jarovce' => [
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Rusovce' => [
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Čunovo' => [
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
        ];
    }

    public function scopeCurrent($query)
    {
        $query->where('is_current', true);
    }

    public static function getFilteredArtworkCountsByBorough(
        Request $searchRequest
    ) {
        $artworkCounts = self::query()
            ->current()
            ->selectRaw('max(locations.borough) as borough')
            ->selectRaw('count(artworks.id) as artworks_count')
            ->join(
                'artwork_location',
                'artwork_location.location_id',
                '=',
                'locations.id'
            )
            ->join(
                'artworks',
                'artwork_location.artwork_id',
                '=',
                'artworks.id'
            )
            ->whereHas('artworks', function (Builder $query) use (
                $searchRequest
            ) {
                $searchRequest = Request::createFrom($searchRequest)->replace(
                    $searchRequest->except('boroughs')
                );

                $query->presentable()->filteredBySearchRequest($searchRequest);
            })
            ->groupBy('borough')
            ->pluck('artworks_count', 'borough');

        return collect(Location::getBoroughs())->map(
            fn($borough, $name) => [
                ...$borough,
                'borough' => $name,
                'artworks_count' => Arr::get($artworkCounts, $name, 0),
            ]
        );
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }

    protected function district(): Attribute
    {
        return Attribute::make(
            get: fn() => Arr::get(
                self::getBoroughs(),
                "{$this->borough}.district"
            )
        );
    }
}
