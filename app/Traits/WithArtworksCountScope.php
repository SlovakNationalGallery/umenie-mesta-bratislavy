<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait WithArtworksCountScope
{
    public static function scopeWithFilteredArtworksCount(
        Builder $query,
        Request $searchRequest,
        string $facetField
    ) {
        $searchRequestExcept = Request::createFrom($searchRequest)->replace(
            $searchRequest->except($facetField)
        );

        $query
            ->whereHas(
                'artworks',
                fn(Builder $query) => $query
                    ->presentable()
                    ->filteredBySearchRequest($searchRequestExcept)
                    ->orWhereIn(
                        $facetField . '.id',
                        $searchRequest->get($facetField, [])
                    )
            )
            ->withCount([
                'artworks' => fn(Builder $query) => $query
                    ->presentable()
                    ->filteredBySearchRequest($searchRequestExcept),
            ]);
    }
}
