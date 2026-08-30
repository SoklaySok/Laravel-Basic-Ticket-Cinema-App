<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'duration' => fake()->numberBetween(90, 180),
            'genre' => fake()->randomElement([
                'Action',
                'Adventure',
                'Comedy',
                'Drama',
                'Horror',
                'Sci-Fi',
                'Animation',
            ]),
            'language' => fake()->randomElement([
                'English',
                'Khmer',
                'Chinese',
                'Korean',
            ]),
            'rating' => fake()->randomElement([
                'G',
                'PG',
                'PG-13',
                'R',
            ]),
            'release_date' => fake()->date(),
            'poster' => null,
            'status' => fake()->randomElement([
                'coming_soon',
                'now_showing',
                'ended',
            ]),
        ];
    }
}
