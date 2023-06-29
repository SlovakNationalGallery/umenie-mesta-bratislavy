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
            $searchRequestExcept = Request::createFrom($searchRequest)->replace(
                $searchRequest->except($except)
            );
            $searchRequestOnly = Request::createFrom($searchRequest)->replace(
                $searchRequest->only($except)
            );

            $query
                ->presentable()
                ->filteredBySearchRequest($searchRequestExcept)
                ->orWhere(function (Builder $query) use ($searchRequestOnly) {
                    $query->filteredBySearchRequest($searchRequestOnly);
                });
        };

        $query
            ->whereHas('artworks', $queryBuilder)
            ->withCount(['artworks' => $queryBuilder]);
    }
}
