<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static array $icons = [
        'fontána, studňa, vodný prvok' => 'fontain',
        'nové médiá, streetart, inštalácia' => 'new-media',
        'pomník' => 'monument',
        'plastika, voľná socha' => 'statue',
        'dielo spojené s architektúrou' => 'architecture',
        'reliéf' => 'relief',
        'pamätná tabuľa' => 'tableau',
        'pamätník' => 'memorial',
        'drobná architektúra, dizajn, herný prvok' => 'playground',
    ];

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

    public function getIconAttribute()
    {
        $categoryName = (string) Str::of($this->name)->trim();
        return self::$icons[$categoryName] ?? 'default';
    }
}
