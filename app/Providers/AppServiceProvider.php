<?php

namespace App\Providers;

use App\Http\Resources\ArtworkMapPointCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->isLocal()) {
            Model::shouldBeStrict();
        }

        ArtworkMapPointCollection::withoutWrapping();
    }
}
