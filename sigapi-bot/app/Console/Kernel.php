<?php

namespace App\Console;

use App\Services\Bot\GetUpdatesService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule) {

        $schedule->call(function() {
            self::repeatAfterSeconds(function() {
                (new GetUpdatesService())->getUpdates();
            }, 5);
        })->everyMinute();

    }

    protected static function repeatAfterSeconds($repeatable, $seconds) {
        $repetitions = (60  / $seconds) - 1;
        for ($i = 0; $i < $repetitions; $i++) {
            $repeatable();
            sleep($seconds);
        }
    }

    protected function commands() {}

}
