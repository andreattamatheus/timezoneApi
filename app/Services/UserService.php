<?php

namespace App\Services;

use App\Models\Timezone;
use App\Models\User;
use Exception;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Update user with random data.
     */
    public function updateUserWithRandomData(string $userEmail): User|Exception
    {
        try {
            $user = User::where('email', $userEmail)->first();
            if (!$user) {
                return new Exception('User not found');
            }

            $faker = Factory::create();
            $timeZone = Timezone::query()->where('id', '!=', $user->timezone_id)->inRandomOrder()->first();

            if (!$timeZone) {
                return new Exception('No suitable timezone found');
            }

            return DB::transaction(function () use ($user, $faker, $timeZone) {
                $user->name = $faker->name;
                $user->lastname = $faker->lastName;
                $user->timezone_id = $timeZone->id;
                $user->save();
                return $user;
            });
        } catch (\Throwable $th) {
            logger()->channel('daily')->error($th->getMessage());
            return new Exception('A problem occurred while updating the user');
        }
    }
}
