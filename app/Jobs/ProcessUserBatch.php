<?php

namespace App\Jobs;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessUserBatch implements ShouldQueue
{
    use Batchable, Queueable;

    protected $users;

    /**
     * Create a new job instance.
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            logger()->channel('api')->info("Processing user [{$user->id}] - firstname: {$user->name}, lastname: {$user->lastname}, timezone: '{$user->timezone->description}'");

            $batchPayload = UserResource::collection($this->users)->toArray(request());
        }

        $this->fakeApiProcess($batchPayload);
    }

    public function fakeApiProcess($batchPayload)
    {
        logger()->channel('api')->info('Fake API request:', $batchPayload);
    }
}
