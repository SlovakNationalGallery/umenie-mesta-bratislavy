<?php

namespace App\Models;

use App\Traits\WithArtworksCountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use WithArtworksCountScope;

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
