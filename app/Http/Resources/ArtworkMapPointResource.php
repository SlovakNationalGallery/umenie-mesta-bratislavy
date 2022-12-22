<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
                'location_address' => $this->currentLocation->address,
                'location_description' => $this->currentLocation->description,
                'detail_url' => route('artworks.show', [
                    'artwork' => $this->resource,
                ]),
            ],
        ];
    }

    protected function icon()
    {
        $icon = str($this->primaryCategory?->icon ?? 'default');
        return $icon->when(
            $this->defunct,
            fn($icon) => $icon->append('-defunct')
        );
    }
}
