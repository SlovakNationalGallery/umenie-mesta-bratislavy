<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Photo extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $incrementing = false;
    protected $keyType = 'string';
}
