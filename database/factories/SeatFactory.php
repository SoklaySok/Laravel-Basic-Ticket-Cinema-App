<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seat>
 */
class SeatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'screen_id' => Screen::factory(),
            'row' => fake()->randomElement([
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
            ]),
            'number' => fake()->numberBetween(1, 10),
            'price' => fake()->randomElement([
                5.00,
                6.00,
                7.00,
            ]),
        ];
    }
}
