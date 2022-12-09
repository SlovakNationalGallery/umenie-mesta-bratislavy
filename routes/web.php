<?php

use App\Jobs\ImportFromAirtable;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\HomeController;
use App\Models\Artwork;
use App\Models\Location;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $stats = Artwork::getStats();
    return view('welcome', [
        'artworks' => Artwork::published()
            ->has('coverPhotoMedia')
            ->with(['authors', 'coverPhotoMedia', 'yearBuilt'])
            ->orderByDesc('created_at')
            ->take(4)
            ->get(),

        'locations' => $stats['locations'],
        'stats' => [
            'artworks' => $stats['count'],
            'boroughs' => $stats['locations']
                ->values()
                ->flatten()
                ->count(),
            'lastUpdate' => $stats['lastUpdate'],
        ],
    ]);
});

Route::get('/o-projekte', function () {
    $stats = Artwork::getStats();

    return view('about', [
        'stats' => [
            'artworks' => $stats['count'],
            'boroughs' => $stats['locations']
                ->values()
                ->flatten()
                ->count(),
            'lastUpdate' => $stats['lastUpdate'],
        ],
    ]);
})->name('about');

Route::resource('diela', ArtworkController::class)
    ->names('artworks')
    ->parameter('diela', 'artwork');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth.basic.prod-only')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('index');

        Route::put('imports/create', function () {
            ImportFromAirtable::dispatch();
            return back()->with('import-dispatched', 'Import bol spustený');
        })->name('imports.create');
    });

Route::get('/vue', function () {
    return view('vue');
});
