<?php

use App\Http\Controllers\Api\ArtworkFiltersController;
use App\Models\Artwork;
use App\Http\Controllers\Api\ArtworkMapPointsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('artworks/filters', ArtworkFiltersController::class)->names(
    'artworks-filters'
);

// TODO combine with API for Map endpoints
Route::get('artworks', function (Request $request) {
    return Artwork::query()
        ->presentable()
        ->filteredBySearchRequest($request)
        ->select('id')
        ->get();
})->name('api.artworks.index');

Route::resource(
    'artworks/map-points',
    ArtworkMapPointsController::class
)->names('artwork-map-points');
