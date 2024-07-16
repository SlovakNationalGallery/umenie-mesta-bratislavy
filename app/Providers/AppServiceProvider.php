<?php

namespace App\Providers;

use App\Http\Resources\ArtworkMapPointCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

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

        Str::macro('airtableMarkdown', function ($value) {
            return Str::of($value)
                ->replaceMatches('/\*\*(\s*)(.*?)(\s*)\*\*/', '$1**$2**$3')
                ->replaceMatches('/_(\s*)(.*?)(\s*)_/', '$1_$2_$3')
                ->replaceMatches('/~~(\s*)(.*?)(\s*)~~/', '$1~~$2~~$3')
                ->markdown();
        });

        Stringable::macro('airtableMarkdown', function () {
            return Str::airtableMarkdown($this->value);
        });
    }
}
