<?php

namespace Database\Seeders;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Movies
        |--------------------------------------------------------------------------
        */

        $movies = Movie::factory(5)->create();

        /*
        |--------------------------------------------------------------------------
        | Cinemas
        |--------------------------------------------------------------------------
        */

        $cinemas = Cinema::factory(2)->create();

        /*
        |--------------------------------------------------------------------------
        | Screens + Seats
        |--------------------------------------------------------------------------
        */

        foreach ($cinemas as $cinema) {

            $screens = Screen::factory(3)->create([
                'cinema_id' => $cinema->id,
            ]);

            foreach ($screens as $screen) {

                foreach (range('A', 'F') as $row) {

                    foreach (range(1, 5) as $number) {

                        Seat::create([
                            'screen_id' => $screen->id,
                            'row' => $row,
                            'number' => $number,
                            'price' => 5.00,
                        ]);
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Showtimes
        |--------------------------------------------------------------------------
        */

        $screens = Screen::with('cinema')->get();

        foreach ($screens as $screen) {

            foreach ($movies->random(3) as $movie) {

                Showtime::create([
                    'movie_id' => $movie->id,
                    'screen_id' => $screen->id,
                    'show_date' => now()->addDays(
                        fake()->numberBetween(1, 7)
                    )->format('Y-m-d'),
                    'start_time' => fake()->randomElement([
                        '10:00:00',
                        '13:00:00',
                        '16:00:00',
                        '19:00:00',
                        '21:30:00',
                    ]),
                    'end_time' => fake()->randomElement([
                        '12:00:00',
                        '15:00:00',
                        '18:00:00',
                        '21:00:00',
                        '23:30:00',
                    ]),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Bookings
        |--------------------------------------------------------------------------
        */

        $showtimes = Showtime::with('screen')->get();

        foreach ($showtimes->take(5) as $showtime) {

            $booking = Booking::create([
                'customer_name' => fake()->name(),
                'customer_phone' => fake()->phoneNumber(),
                'showtime_id' => $showtime->id,
                'total_amount' => 0,
                'status' => 'confirmed',
            ]);

            $seats = Seat::where(
                'screen_id',
                $showtime->screen_id
            )->take(2)->get();

            $total = 0;

            foreach ($seats as $seat) {

                BookingItem::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seat->id,
                    'price' => $seat->price,
                ]);

                $total += $seat->price;
            }

            $booking->update([
                'total_amount' => $total,
            ]);
        }
    }
}
