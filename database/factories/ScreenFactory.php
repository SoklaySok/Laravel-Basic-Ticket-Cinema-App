<?php

namespace Database\Factories;

use App\Models\Screen;
use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Screen>
 */
class ScreenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cinema_id' => Cinema::factory(),
            'name' => 'Screen ' . fake()->numberBetween(1, 10),
            'capacity' => 30,
        ];
    }
}
