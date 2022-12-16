<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkMapPointCollection;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtworkMapPointsController extends Controller
{
    public function index(Request $request)
    {
        $artworks = Artwork::query()
            ->with(['currentLocation', 'conditions', 'primaryCategory'])
            ->has('currentLocation')
            ->presentable()
            ->filteredBySearchRequest($request)
            ->get();

        return new ArtworkMapPointCollection($artworks);
    }
}
