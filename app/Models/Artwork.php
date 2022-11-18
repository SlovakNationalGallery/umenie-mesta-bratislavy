<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $incrementing = false;
    protected $keyType = 'string';

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->wherePivot('role', 'author')
            ->orderByPivot('order');
    }

    public function coauthors()
    {
        return $this->belongsToMany(Author::class)
            ->wherePivot('role', 'coauthor')
            ->orderByPivot('order');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class)->orderByPivot('order');
    }

    public function currentLocation()
    {
        return $this->hasOneDeepFromRelations($this->locations())
            ->where('is_current', true)
            ->orderBy('artwork_location.order')
            ->limit(1);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class)->orderByPivot('order');
    }

    public function coverPhotoMedia()
    {
        return $this->hasOneDeepFromRelations(
            $this->photos(),
            (new Photo())->media()
        )
            ->orderBy('artwork_photo.order')
            ->orderBy('media.order_column')
            ->limit(1);
    }
}
