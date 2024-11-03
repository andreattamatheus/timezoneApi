<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUserBatch;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;

class ProcessUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-users';

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
        $batchSize = config('queue.api_request_limit_batch');
        $batches = [];
        $changedUsers = User::query()->where(function ($query) {
            $query->whereColumn('name', '!=', 'old_name')
                ->orWhereColumn('lastname', '!=', 'old_lastname')
                ->orWhereColumn('timezone_id', '!=', 'old_timezone');
        });

        $delayInMinutes = $this->getDelayInMinutes($changedUsers, $batchSize);

        $changedUsers->chunk($batchSize, function ($users) use (&$batches, $delayInMinutes) {
            $job = new ProcessUserBatch($users);
            $batches[] = $job->delay(now()->addMinutes(count($batches) * $delayInMinutes));
        });

        if (!empty($batches)) {
            Bus::batch($batches)->dispatch();
            $this->info('User processing batch has been dispatched.');
        } else {
            $this->info('No users to process.');
        }
    }

    protected function getDelayInMinutes(Builder $changedUsers, int $batchSize): int
    {
        $totalUsers = $changedUsers->get()->count();
        $totalBatches = ceil($totalUsers / $batchSize);
        if ($totalBatches > config('queue.api_request_limit_hour')) {
            $totalBatches = config('queue.api_request_limit_hour');
        }
        $hourInMinutes = 60;

        return ceil($hourInMinutes / $totalBatches);
    }
}
