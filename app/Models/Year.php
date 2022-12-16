<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    public function toFormattedString()
    {
        if ($this->description) {
            return $this->description;
        }

        if ($this->latest && $this->latest != $this->earliest) {
            return sprintf('%s—%s', $this->earliest, $this->latest);
        }

        return $this->earliest;
    }
}
