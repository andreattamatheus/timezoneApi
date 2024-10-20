<?php

namespace Database\Seeders;

use App\Models\Timezone;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezoneArray = [
            'CET',
            'CST',
            'GMT+1'
        ];

        foreach ($timezoneArray as $timezone) {
            Timezone::create(['description' => $timezone]);
        }
    }
}
