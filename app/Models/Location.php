<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Location extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    public $incrementing = false;
    protected $keyType = 'string';

    public static function getBoroughs()
    {
        return collect([
            'Staré Mesto' => [
                'name' => 'Staré Mesto',
                'district' => 'Bratislava I',
                'district_short' => 'I',
            ],
            'Ružinov' => [
                'name' => 'Ružinov',
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Vrakuňa' => [
                'name' => 'Vrakuňa',
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Podunajské Biskupice' => [
                'name' => 'Podunajské Biskupice',
                'district' => 'Bratislava II',
                'district_short' => 'II',
            ],
            'Nové Mesto' => [
                'name' => 'Nové Mesto',
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Rača' => [
                'name' => 'Rača',
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Vajnory' => [
                'name' => 'Vajnory',
                'district' => 'Bratislava III',
                'district_short' => 'III',
            ],
            'Karlova Ves' => [
                'name' => 'Karlova Ves',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Dúbravka' => [
                'name' => 'Dúbravka',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Lamač' => [
                'name' => 'Lamač',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Devín' => [
                'name' => 'Devín',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Devínska Nová Ves' => [
                'name' => 'Devínska Nová Ves',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Záhorská Bystrica' => [
                'name' => 'Záhorská Bystrica',
                'district' => 'Bratislava IV',
                'district_short' => 'IV',
            ],
            'Petržalka' => [
                'name' => 'Petržalka',
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Jarovce' => [
                'name' => 'Jarovce',
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Rusovce' => [
                'name' => 'Rusovce',
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
            'Čunovo' => [
                'name' => 'Čunovo',
                'district' => 'Bratislava V',
                'district_short' => 'V',
            ],
        ]);
    }

    public function scopeCurrent($query)
    {
        $query->where('is_current', true);
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }

    protected function district(): Attribute
    {
        return Attribute::make(
            get: fn() => Arr::get(
                self::getBoroughs(),
                "{$this->borough}.district"
            )
        );
    }
}
