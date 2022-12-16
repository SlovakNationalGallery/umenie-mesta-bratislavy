<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArtworkMapPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array\Illuminate\Contracts\Support\Arrayable\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $this->currentLocation->gps_lon,
                    $this->currentLocation->gps_lat,
                ],
            ],
            'properties' => [
                'id' => $this->id,
                'name' => $this->name,
                'icon' => $this->icon(),
            ],
        ];
    }

    protected function icon()
    {
        $icon = str($this->primaryCategory?->icon ?? 'default');
        return $icon->when(
            $this->defunct,
            fn ($icon) => $icon->append('-defunct')
        );
    }
}
