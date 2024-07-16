<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $artworks = Artwork::query()
            ->presentable()
            ->filteredBySearchRequest($request)
            ->with(['authors', 'coverPhotoMedia', 'yearBuilt'])
            ->orderByDesc('is_promoted')
            ->orderByDesc('created_at')
            ->orderBy('id')
            ->paginate(12);

        return view('artworks.index', compact(['artworks', 'categories']));
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
    public function show(string $artwork)
    {
        $artwork = Artwork::presentable()->findOrFail($artwork);

        $relatedArtworks = Artwork::query()
            ->select('artworks.*')
            ->selectCurrentLocationDistance($artwork)
            ->presentable()
            ->whereNot('artworks.id', $artwork->id)
            ->orderBy('distance')
            ->limit(4)
            ->with('coverPhotoMedia', 'authors', 'yearBuilt')
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
