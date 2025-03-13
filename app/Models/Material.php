<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\WithArtworksCountScope;

class Material extends Model
{
    use HasFactory;
    use WithArtworksCountScope;

    protected $keyType = 'string';

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }
}
