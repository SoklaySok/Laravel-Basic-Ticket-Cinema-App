<?php

namespace Database\Factories;

use App\Models\Showtime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Showtime>
 */
class ShowtimeFactory extends Factory
{
    public function definition(): array
    {
        $startHour = fake()->numberBetween(10, 21);

        return [
            'movie_id' => Movie::factory(),
            'screen_id' => Screen::factory(),
            'show_date' => fake()->dateTimeBetween(
                'today',
                '+30 days'
            )->format('Y-m-d'),
            'start_time' => sprintf('%02d:00:00', $startHour),
            'end_time' => sprintf('%02d:30:00', $startHour + 2),
        ];
    }
}
