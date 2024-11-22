<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            ['status' => true, 'location_quantity' => 2, 'event_id' => 1, 'user_id' => 1],
            ['status' => true, 'location_quantity' => 1, 'event_id' => 1, 'user_id' => 2],
            ['status' => true, 'location_quantity' => 3, 'event_id' => 1, 'user_id' => 3],
            ['status' => true, 'location_quantity' => 4, 'event_id' => 2, 'user_id' => 4],
            ['status' => true, 'location_quantity' => 2, 'event_id' => 2, 'user_id' => 5],
            ['status' => true, 'location_quantity' => 5, 'event_id' => 3, 'user_id' => 6],
            ['status' => true, 'location_quantity' => 1, 'event_id' => 3, 'user_id' => 7],
            ['status' => false, 'location_quantity' => 2, 'event_id' => 3, 'user_id' => 8],
            ['status' => true, 'location_quantity' => 2, 'event_id' => 4, 'user_id' => 9],
            ['status' => true, 'location_quantity' => 4, 'event_id' => 4, 'user_id' => 10],
            ['status' => true, 'location_quantity' => 2, 'event_id' => 5, 'user_id' => 11],
            ['status' => true, 'location_quantity' => 3, 'event_id' => 5, 'user_id' => 12],
            ['status' => false, 'location_quantity' => 1, 'event_id' => 1, 'user_id' => 13],
            ['status' => true, 'location_quantity' => 4, 'event_id' => 2, 'user_id' => 14],
            ['status' => true, 'location_quantity' => 3, 'event_id' => 3, 'user_id' => 15],
            ['status' => true, 'location_quantity' => 1, 'event_id' => 4, 'user_id' => 16],
            ['status' => false, 'location_quantity' => 2, 'event_id' => 5, 'user_id' => 17],
            ['status' => true, 'location_quantity' => 2, 'event_id' => 1, 'user_id' => 18],
            ['status' => true, 'location_quantity' => 2, 'event_id' => 2, 'user_id' => 19],
            ['status' => false, 'location_quantity' => 1, 'event_id' => 3, 'user_id' => 20],
        ];

        foreach ($reservations as $reservation) {
            Reservation::firstOrCreate([
                'status' => $reservation['status'],
                'location_quantity' => $reservation['location_quantity'],
                'event_id' => $reservation['event_id'],
                'user_id' => $reservation['user_id']
            ]);
        }
    }
}
