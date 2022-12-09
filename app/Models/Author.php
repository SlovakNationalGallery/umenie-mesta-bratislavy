<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
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

    public function getNameAttribute()
    {
        return $this->other_name ??
            collect([$this->first_name, $this->last_name])->join(' ');
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }
}
