<?php

namespace Database\Factories;

use App\Models\BookingItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookingItem>
 */
class BookingItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'seat_id' => Seat::factory(),
            'price' => 5.00,
        ];
    }
}
