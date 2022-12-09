<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Author;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filteredArtworkIds = $artworks = Artwork::query()
            ->select('id')
            ->published()
            ->has('coverPhotoMedia')
            ->get()
            ->modelKeys();

        $artworks = Artwork::query()
            ->with(['authors', 'coverPhotoMedia', 'yearBuilt'])
            ->whereIn('id', $filteredArtworkIds)
            ->paginate(12);

        $boroughCounts = Location::selectRaw('count(id) as count, borough')
            ->current()
            ->whereHas('artworks', function (Builder $query) use (
                $filteredArtworkIds
            ) {
                $query->whereIn('id', $filteredArtworkIds);
            })
            ->groupBy('borough')
            ->pluck('count', 'borough');

        $filters = [
            'boroughs' => Location::getBoroughs()->map(function ($b) use (
                $boroughCounts
            ) {
                return [
                    'value' => $b['name'],
                    'label' => $b['name'],
                    'district_short' => $b['district_short'],
                    'count' => Arr::get($boroughCounts, $b['name'], 0),
                    'selected' => false, // TODO
                ];
            }),
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

        return view('artworks.index', compact(['artworks', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $artwork)
    {
        // TODO related by distance from $artwork
        $relatedArtworks = Artwork::published()
            ->inRandomOrder()
            ->with('coverPhotoMedia', 'authors', 'yearBuilt')
            ->has('coverPhotoMedia')
            ->limit(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
