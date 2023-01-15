<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Si Tukang Request',
            'username' => 'rizky',
            'password' => bcrypt('password12345'),
            'role' => 1,
        ]);

        User::create([
            'name' => 'Si Approval',
            'username' => 'anna',
            'password' => bcrypt('password12345'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'Si Warehouse',
            'username' => 'wasiman',
            'password' => bcrypt('password12345'),
            'role' => 3,
        ]);
    }
}
