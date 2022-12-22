<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Author;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ArtworkFiltersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filteredArtworkIds = Artwork::query()
            ->presentable()
            ->filteredBySearchRequest($request)
            ->select('id')
            ->get()
            ->modelKeys();

        $boroughCounts = Location::selectRaw('count(id) as count, borough')
            ->current()
            ->whereHas('artworks', function (Builder $query) use (
                $filteredArtworkIds
            ) {
                $query->whereIn('id', $filteredArtworkIds);
            })
            ->groupBy('borough')
            ->pluck('count', 'borough');

        return [
            'boroughs' => collect(Location::getBoroughs())
                ->map(function ($b, $name) use ($boroughCounts) {
                    return [
                        'value' => $name,
                        'label' => $name,
                        'district_short' => $b['district_short'],
                        'icon' => 'images/boroughs/' . Str::snake($name) . '.svg',
                        'count' => Arr::get($boroughCounts, $name, 0),
                    ];
                })
                ->values(),

            'authors' => Author::query()
                ->select('id', 'first_name', 'last_name', 'other_name')
                ->withFilteredArtworksCount($filteredArtworkIds)
                ->orderByDesc('artworks_count')
                ->orderByRaw('COALESCE(last_name, other_name)')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->name,
                        'count' => $a->artworks_count,
                    ]
                ),

            'categories' => Category::query()
                ->select('id', 'name')
                ->withFilteredArtworksCount($filteredArtworkIds)
                ->orderByDesc('artworks_count')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->name,
                        'count' => $a->artworks_count,
                    ]
                ),

            'keywords' => Keyword::query()
                ->select('id', 'keyword')
                ->withFilteredArtworksCount($filteredArtworkIds)
                ->orderByDesc('artworks_count')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->keyword,
                        'count' => $a->artworks_count,
                    ]
                ),
        ];
    }
}
