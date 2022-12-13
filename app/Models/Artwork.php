<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Artwork extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $incrementing = false;
    protected $keyType = 'string';

    public static function getStats()
    {
        return Cache::rememberForever(
            'artworks.stats',
            fn() => [
                'lastUpdate' => optional(
                    self::orderByDesc('updated_at')->first()
                )->updated_at,
                'count' => self::published()->count(),
                'locations' => Location::selectRaw(
                    'count(id) as count, borough'
                )
                    ->current()
                    ->whereHas('artworks', function (Builder $query) {
                        $query->published();
                    })
                    ->groupBy('borough')
                    ->get()
                    ->groupBy('district')
                    ->collect() // Turn to Laravel collection
                    ->except(''), // Filter out locations with empty district
            ]
        );
    }

    public function scopePublished($query)
    {
        // TODO enable before launch
        // $query->where('is_published', true);
    }

    // default scope for those artworks that we can actually display
    public function scopePresentable($query)
    {
        $query->published()->has('coverPhotoMedia');
    }

    public function scopeFilteredBySearchRequest($query, Request $request)
    {
        $request->whenFilled('boroughs', function ($boroughs) use ($query) {
            $query->whereHas('locations', function (Builder $query) use (
                $boroughs
            ) {
                $query->current()->whereIn('borough', $boroughs);
            });
        });

        $request->whenFilled('authors', function ($authorIds) use ($query) {
            $query->whereHas('authorsAndCoauthors', function (
                Builder $query
            ) use ($authorIds) {
                $query->whereIn('id', $authorIds);
            });
        });

        $request->whenFilled('categories', function ($categoryIds) use (
            $query
        ) {
            $query->whereHas('categories', function (Builder $query) use (
                $categoryIds
            ) {
                $query->whereIn('id', $categoryIds);
            });
        });

        $request->whenFilled('keywords', function ($keywordIds) use ($query) {
            $query->whereHas('keywords', function (Builder $query) use (
                $keywordIds
            ) {
                $query->whereIn('id', $keywordIds);
            });
        });
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->wherePivot('role', 'author')
            ->orderByPivot('order');
    }

    public function authorsAndCoauthors()
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('role')
            ->orderByPivot('role')
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
            ->current()
            ->orderBy('artwork_location.order')
            ->limit(1);
    }

    public function primaryCategory()
    {
        return $this->hasOneDeepFromRelations($this->categories())
            ->orderBy('artwork_category.order')
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

    public function defunct(): Attribute
    {
        return Attribute::get(
            fn() => $this->conditions->contains(
                fn(Condition $condition) => str($condition->name)
                    ->trim()
                    ->exactly('zničené, odstránené')
            )
        );
    }
}
