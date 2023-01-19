<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Requester
        User::create([
            'name' => 'Developer',
            'username' => 'rizky',
            'password' => bcrypt('password12345'),
            'role' => 1,
        ]);
        User::create([
            'name' => 'Subcont',
            'username' => 'chandra',
            'password' => bcrypt('password12345'),
            'role' => 1,
        ]);
        User::create([
            'name' => 'Sample Room',
            'username' => 'sandy',
            'password' => bcrypt('password12345'),
            'role' => 1,
        ]);

        // Material Planning
        User::create([
            'name' => 'Material Planning',
            'username' => 'anna',
            'password' => bcrypt('password12345'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'Material Planning',
            'username' => 'ratih',
            'password' => bcrypt('password12345'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'Material Planning',
            'username' => 'neni',
            'password' => bcrypt('password12345'),
            'role' => 2,
        ]);

        // Warehouse
        User::create([
            'name' => 'Warehouse',
            'username' => 'wasiman',
            'password' => bcrypt('password12345'),
            'role' => 3,
        ]);
        User::create([
            'name' => 'Warehouse',
            'username' => 'jaya',
            'password' => bcrypt('password12345'),
            'role' => 3,
        ]);
    }
}
