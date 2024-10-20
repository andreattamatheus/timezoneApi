<?php

namespace Database\Seeders;

use App\Models\Timezone;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersArray = [
            [
                'name' => 'Backoffice',
                'email' => 'backoffice@yopmail.com',
                'timezone_id' => Timezone::query()->inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@yopmail.com',
                'timezone_id' => Timezone::query()->inRandomOrder()->first()->id,
            ],
        ];

        foreach ($usersArray as $user) {
            User::create([
                'name' => $user['name'],
                'lastname' => 'User',
                'email' => $user['email'],
                'password' => bcrypt('123123123'),
                'timezone_id' => $user['timezone_id'],
            ]);
        }
    }
}
