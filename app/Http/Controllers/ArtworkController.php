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
    public function index(Request $request)
    {
        $artworks = Artwork::query()
            ->presentable()
            ->filteredBySearchRequest($request)
            ->with(['authors', 'coverPhotoMedia', 'yearBuilt'])
            ->paginate(12);

        return view('artworks.index', compact(['artworks']));
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
        // TODO GMBUVP-18
        // $relatedArtworks = Artwork::published()
        //     ->with('coverPhotoMedia', 'authors', 'yearBuilt')
        //     ->has('coverPhotoMedia')
        //     ->limit(4)
        //     ->get();

        return view('artworks.show', compact('artwork'));
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
