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
                'name' => 'Samantha',
                'lastname' => 'Backoffice lastname',
                'email' => 'backoffice@yopmail.com',
                'timezone_id' => 1,
                'old_timezone' => 1,
            ],
            [
                'name' => 'Admin 1',
                'old_name' => 'Admin 1',
                'lastname' => 'User',
                'email' => 'admin1@yopmail.com',
                'timezone_id' => Timezone::query()->inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Admin 2',
                'lastname' => 'User',
                'old_lastname' => 'User',
                'email' => 'admin2@yopmail.com',
                'timezone_id' => Timezone::query()->inRandomOrder()->first()->id,
            ],
        ];

        for ($i = 0; $i < count($usersArray); $i++) {
            User::create([
                'name' => $usersArray[$i]['name'],
                'old_name' => $usersArray[$i]['old_name'] ?? null,
                'lastname' => $usersArray[$i]['lastname'],
                'old_lastname' => $usersArray[$i]['old_lastname'] ?? null,
                'email' => $usersArray[$i]['email'],
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'),
                'timezone_id' => $usersArray[$i]['timezone_id'],
                'old_timezone' => $usersArray[$i]['old_timezone'] ?? null,
            ]);
        }

        User::factory()->count(60)->create();
    }
}
