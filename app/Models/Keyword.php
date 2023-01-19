<?php

namespace App\Models;

use App\Traits\WithArtworksCountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    use WithArtworksCountScope;

    public $incrementing = false;
    protected $keyType = 'string';

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }
}
