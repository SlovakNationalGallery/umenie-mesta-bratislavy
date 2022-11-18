<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
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
            'address' => fake()->streetAddress(),

            // min and max roughly fitting inside Bratislava region
            'gps_lat' => fake()->longitude(
                $min = 48.0789028,
                $max = 48.1876039
            ),
            'gps_lon' => fake()->longitude(
                $min = 16.9797442,
                $max = 17.2548144
            ),
        ];
    }
}
