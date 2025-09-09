<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'name' => 'Kamar 1',
            'capacity' => 2,
            'price' => 300000,
            'description' => 'Kamar dengan kapasitas 2 orang',
            'image' => null,
        ]);

        Room::create([
            'name' => 'Kamar 2',
            'capacity' => 3,
            'price' => 400000,
            'description' => 'Kamar dengan kapasitas 3 orang',
            'image' => null,
        ]);

        Room::create([
            'name' => 'Ruang Serbaguna',
            'capacity' => 20,
            'price' => 1500000,
            'description' => 'Ruangan cocok untuk meeting atau acara',
            'image' => null,
        ]);
    }
}
