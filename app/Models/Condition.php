<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\WithArtworksCountScope;

class Condition extends Model
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
