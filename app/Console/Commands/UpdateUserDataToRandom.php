<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class UpdateUserDataToRandom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-data-to-random {email : User email to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userService = new UserService();
        $email = $this->argument('email');
        $updateUser = $userService->updateUserWithRandomData($email);
        if ($updateUser instanceof \Exception) {
            $this->error($updateUser->getMessage());
            return 1;
        }
        $this->info('User updated successfully');
    }
}
