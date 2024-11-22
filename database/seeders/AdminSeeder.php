<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin Uno',
                'email' => 'admin1@example.com',
                'password' => bcrypt('1234'),
            ],
            [
                'name' => 'Admin Dos',
                'email' => 'admin2@example.com',
                'password' => bcrypt('1234'),
            ],
            [
                'name' => 'Admin Tres',
                'email' => 'admin3@example.com',
                'password' => bcrypt('1234'),
            ]
        ];

        foreach ($admins as $admin) {
            Admin::firstOrCreate([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => $admin['password']
            ]);
        }
    }
}
