<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArtworkMapPointResource extends JsonResource
{
    protected static array $icons = [
        'fontána, studňa, vodný prvok' => 'fontain',
        'nové médiá, streetart, inštalácia' => 'new-media',
        'pomník' => 'monument',
        'plastika, voľná socha' => 'statue',
        'dielo spojené s architektúrou' => 'architecture',
        'reliéf' => 'relief',
        'pamätná tabuľa' => 'tableau',
        'pamätník' => 'memorial',
        'drobná architektúra, dizajn, herný prvok' => 'playground',
    ];

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
        $categoryName = (string) str($this->primaryCategory?->name)->trim();
        $icon = str(self::$icons[$categoryName] ?? 'default');
        return $icon->when(
            $this->defunct,
            fn($icon) => $icon->append('-defunct')
        );
    }
}
