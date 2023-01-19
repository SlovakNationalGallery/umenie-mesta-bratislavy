<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait WithArtworksCountScope
{
    public static function scopeWithFilteredArtworksCount(
        Builder $query,
        Request $searchRequest,
        string $except
    ) {
        $queryBuilder = function (Builder $query) use (
            $searchRequest,
            $except
        ) {
            $searchRequest = Request::createFrom($searchRequest)->replace(
                $searchRequest->except($except)
            );

            $query->presentable()->filteredBySearchRequest($searchRequest);
        };

        $query
            ->whereHas('artworks', $queryBuilder)
            ->withCount(['artworks' => $queryBuilder]);
    }
}
