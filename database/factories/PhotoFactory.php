<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class PhotoFactory extends Factory
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

    public function withMedia(): Factory
    {
        return $this->afterCreating(function (Photo $photo) {
            $photo
                ->addMediaFromUrl($this->faker->imageUrl())
                ->toMediaCollection('photos');
        });
    }
}
