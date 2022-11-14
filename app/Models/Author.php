<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function getNameAttribute()
    {
        return $this->other_name ??
            collect([$this->first_name, $this->last_name])->join(' ');
    }
}
