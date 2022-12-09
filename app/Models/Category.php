<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public static function scopeWithFilteredArtworksCount(
        Builder $query,
        array $artworkIds
    ) {
        $query
            ->whereHas('artworks', function (Builder $query) use ($artworkIds) {
                $query->whereIn('id', $artworkIds);
            })
            ->withCount([
                'artworks' => function (Builder $query) use ($artworkIds) {
                    $query->whereIn('id', $artworkIds);
                },
            ]);
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }
}
