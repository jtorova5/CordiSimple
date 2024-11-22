<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            ['Type' => 'confirmación', 'Message' => 'Reserva confirmada!', 'MailingDate' => '2024-10-31', 'AdminId' => 1, 'UserId' => 1],
            ['Type' => 'cancelación', 'Message' => 'Reserva cancelada!', 'MailingDate' => '2024-11-01', 'AdminId' => 1, 'UserId' => 1],
            ['Type' => 'confirmación', 'Message' => 'Reserva confirmada!', 'MailingDate' => '2024-09-30', 'AdminId' => 1, 'UserId' => 2],
            ['Type' => 'cancelación', 'Message' => 'Reserva cancelada!', 'MailingDate' => '2024-10-02', 'AdminId' => 1, 'UserId' => 2],
            ['Type' => 'confirmación', 'Message' => 'Reserva confirmada!', 'MailingDate' => '2024-10-03', 'AdminId' => 1, 'UserId' => 1]
        ];

        foreach ($notifications as $notification) {
            Notification::firstOrCreate([
                'Type' => $notification['Type'],
                'Message' => $notification['Message'],
                'MailingDate' => $notification['MailingDate'],
                'admin_id' => $notification['AdminId'],
                'user_id' => $notification['UserId']
            ]);
        }
    }
}
