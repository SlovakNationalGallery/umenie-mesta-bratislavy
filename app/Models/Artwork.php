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

    public function categories()
    {
        return $this->belongsToMany(Category::class)->orderByPivot('order');
    }

    public function coauthors()
    {
        return $this->belongsToMany(Author::class)
            ->wherePivot('role', 'coauthor')
            ->orderByPivot('order');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class)->orderByPivot('order');
    }

    public function conditions()
    {
        return $this->belongsToMany(Condition::class)->orderByPivot('order');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class)->orderByPivot('order');
    }

    public function maintainers()
    {
        return $this->belongsToMany(Proprietor::class)
            ->wherePivot('role', 'maintainer')
            ->orderByPivot('order');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->orderByPivot('order');
    }

    public function owners()
    {
        return $this->belongsToMany(Proprietor::class)
            ->wherePivot('role', 'owner')
            ->orderByPivot('order');
    }

    public function registrations()
    {
        return $this->belongsToMany(Registration::class)->orderByPivot('order');
    }

    public function signatures()
    {
        return $this->belongsToMany(Signature::class)->orderByPivot('order');
    }

    public function techniques()
    {
        return $this->belongsToMany(Technique::class)->orderByPivot('order');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class)->orderByPivot('order');
    }

    public function years()
    {
        return $this->belongsToMany(Year::class)->orderBy('earliest');
    }

    // Special queries
    public function signature()
    {
        return $this->hasOneDeepFromRelations($this->signatures())
            ->orderBy('artwork_signature.order')
            ->limit(1);
    }

    public function yearBuilt()
    {
        return $this->hasOneDeepFromRelations($this->years())
            ->where('type', 'realizácia') // TODO use a constant
            ->limit(1);
    }

    public function currentLocation()
    {
        return $this->hasOneDeepFromRelations($this->locations())
            ->where('is_current', true)
            ->orderBy('artwork_location.order')
            ->limit(1);
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
