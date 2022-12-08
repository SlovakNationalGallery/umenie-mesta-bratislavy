<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected function district(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->borough === 'Lamač') {
                    return 'Bratislava IV';
                }
                // TODO
            }
        );
    }
}
