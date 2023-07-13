<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->uuid(),
        ];
    }

    public function presentable(): Factory
    {
        return $this->state(fn() => ['is_published' => true])
            ->hasAttached(Location::factory(), [
                'order' => 0,
            ])
            ->hasAttached(Photo::factory()->withMedia(), [
                'order' => 0,
            ]);
    }
}
