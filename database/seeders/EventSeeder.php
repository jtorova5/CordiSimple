<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Concierto de Rock',
                'description' => 'Un emocionante concierto de rock en vivo con bandas locales.',
                'date' => '2024-11-10',
                'location' => 'Estadio Municipal',
                'max_capacity' => 5000,
                'sold' => 1500,
                'admin_id' => 1
            ],
            [
                'name' => 'Festival de Jazz',
                'description' => 'Festival anual de jazz con artistas de renombre.',
                'date' => '2024-12-05',
                'location' => 'Parque Central',
                'max_capacity' => 3000,
                'sold' => 1200,
                'admin_id' => 1
            ],
            [
                'name' => 'Exposición de Arte',
                'description' => 'Muestra de obras de arte contemporáneo de artistas locales.',
                'date' => '2024-11-20',
                'location' => 'Centro Cultural',
                'max_capacity' => 200,
                'sold' => 50,
                'admin_id' => 2
            ],
            [
                'name' => 'Conferencia de Tecnología',
                'description' => 'Conferencia sobre las últimas innovaciones tecnológicas.',
                'date' => '2024-12-15',
                'location' => 'Auditorio Principal',
                'max_capacity' => 1000,
                'sold' => 800,
                'admin_id' => 3
            ],
            [
                'name' => 'Maratón Anual',
                'description' => 'Participa en la maratón más grande de la ciudad.',
                'date' => '2024-11-25',
                'location' => 'Avenida Principal',
                'max_capacity' => 2000,
                'sold' => 1800,
                'admin_id' => 2,
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate([
                'name' => $event['name'],
                'description' => $event['description'],
                'date' => $event['date'],
                'location' => $event['location'],
                'max_capacity' => $event['max_capacity'],
                'sold' => $event['sold'],
                'admin_id' => $event['admin_id']
            ]);
        }
    }
}
