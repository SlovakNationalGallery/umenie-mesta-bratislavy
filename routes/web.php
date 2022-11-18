<?php

use App\Jobs\ImportFromAirtable;
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
    return view('welcome');
});

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
