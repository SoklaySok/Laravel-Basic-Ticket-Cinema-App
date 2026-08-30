<?php

namespace Database\Factories;

use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cinema>
 */
class CinemaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Cinema',
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
