<?php

namespace App\Models;

use App\Traits\WithArtworksCountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use WithArtworksCountScope;

    public $incrementing = false;
    protected $keyType = 'string';

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
