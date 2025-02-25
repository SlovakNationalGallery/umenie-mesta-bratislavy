<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Keyword;
use App\Models\Location;
use App\Models\Material;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
        return [
            'boroughs' => Location::getFilteredArtworksCountByBorough($request)
                ->map(function ($b) {
                    return [
                        'value' => $b['borough'],
                        'label' => $b['borough'],
                        'district_short' => $b['district_short'],
                        'icon_src' => asset(
                            'images/boroughs/' .
                                Str::snake($b['borough']) .
                                '.svg'
                        ),
                        'count' => $b['artworks_count'],
                    ];
                })
                ->values(),

            'authors' => Author::query()
                ->select('id', 'first_name', 'last_name', 'other_name')
                ->withFilteredArtworksCount($request, facetField: 'authors')
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
                ->withFilteredArtworksCount($request, facetField: 'categories')
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
                ->withFilteredArtworksCount($request, facetField: 'keywords')
                ->orderByDesc('artworks_count')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->keyword,
                        'count' => $a->artworks_count,
                    ]
                ),
            'materials' => Material::query()
                ->select('id', 'name')
                ->withFilteredArtworksCount($request, facetField: 'materials')
                ->orderByDesc('artworks_count')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->name,
                        'count' => $a->artworks_count,
                    ]
                ),
            'conditions' => Condition::query()
                ->select('id', 'name')
                ->withFilteredArtworksCount($request, facetField: 'conditions')
                ->orderByDesc('artworks_count')
                ->get()
                ->map(
                    fn($a) => [
                        'value' => $a->id,
                        'label' => $a->name,
                        'count' => $a->artworks_count,
                    ]
                ),
            'min_year' => Year::query()
                ->select('id', 'earliest')
                ->whereHas(
                     'artworks',
                     fn(Builder $query) => $query
                         ->presentable()
                         ->filteredBySearchRequest(
                             Request::createFrom($request)->replace(
                                 $request->except('min_year', 'max_year')
                             )
                         )
                )
                ->min(column: 'earliest')
            ,
            'max_year' => Year::query()
                ->select('id', 'earliest')
                ->whereHas(
                     'artworks',
                     fn(Builder $query) => $query
                         ->presentable()
                         ->filteredBySearchRequest(
                             Request::createFrom($request)->replace(
                                 $request->except('min_year', 'max_year')
                             )
                         )
                )
                ->max(column: 'latest')
            ,                
        ];
    }
}
