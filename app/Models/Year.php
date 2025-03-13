<?php

namespace App\Models;

use App\Traits\WithArtworksCountScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use WithArtworksCountScope;
    
    public function toFormattedString()
    {
        if ($this->description) {
            return $this->description;
        }

        if ($this->latest && $this->latest != $this->earliest) {
            return sprintf('%s – %s', $this->earliest, $this->latest);
        }

        return $this->earliest;
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }
}
