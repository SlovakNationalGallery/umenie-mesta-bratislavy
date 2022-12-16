<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkMapPointCollection;
use App\Models\Artwork;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArtworkMapPointsController extends Controller
{
    public function index(Request $request)
    {
        $artworks = Artwork::query()
            ->with(['currentLocation', 'conditions', 'primaryCategory'])
            ->whereHas('currentLocation', function (Builder $query) {
                $query->whereNotNull(['gps_lon', 'gps_lat']);
            })
            ->presentable()
            ->filteredBySearchRequest($request)
            ->get();

        return new ArtworkMapPointCollection($artworks);
    }
}
