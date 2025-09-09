<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );

        // User biasa 1
        User::updateOrCreate(
            ['email' => 'user1@example.com'],
            [
                'name' => 'User Satu',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );

        // User biasa 2
        User::updateOrCreate(
            ['email' => 'user2@example.com'],
            [
                'name' => 'User Dua',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
    }
}
