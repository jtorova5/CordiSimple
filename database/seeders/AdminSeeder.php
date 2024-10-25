<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'Admin Dos',
                'email' => 'admin2@example.com',
                'password' => Hash::make('456'),
            ],
            [
                'name' => 'Admin Tres',
                'email' => 'admin3@example.com',
                'password' => Hash::make('789'),
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
