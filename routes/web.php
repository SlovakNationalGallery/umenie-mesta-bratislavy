<?php

use App\Jobs\ImportFromAirtable;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\HomeController;
use App\Models\Artwork;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/o-projekte', function () {
    return view('about', ['stats' => Artwork::getStats()]);
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
