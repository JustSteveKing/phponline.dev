<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\Feeds\FetchFeedItems;
use App\Console\Commands\Streams\SyncFromLaraStreams;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(
            command: SyncFromLaraStreams::class,
        )->hourly();

        $schedule->command(
            command: FetchFeedItems::class,
        )->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
