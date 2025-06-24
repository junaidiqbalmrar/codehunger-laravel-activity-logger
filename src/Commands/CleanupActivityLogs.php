<?php

namespace LaravelActivityLogger\Commands;

use Illuminate\Console\Command;
use LaravelActivityLogger\Models\UserActivity;

class CleanupActivityLogs extends Command
{
    protected $signature = 'activity:cleanup';
    protected $description = 'Delete user activity logs older than X days';

    public function handle()
    {
        $days = config('activitylogger.cleanup_days', 30);
        $count = UserActivity::where('created_at', '<', now()->subDays($days))->delete();

        $this->info("Deleted $count activity logs older than $days days.");
    }
}
