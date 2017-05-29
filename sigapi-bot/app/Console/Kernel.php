<?php

namespace App\Console;

use App\Services\Bot\GetUpdatesService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel {

    protected function schedule(Schedule $schedule) {

        $schedule->call(function() {
            $this->monitorQueue();
        })->name('monitor_queue_listener')->everyMinute();

        $schedule->call(function() {
            self::repeatAfterSeconds(function() {
                (new GetUpdatesService())->getUpdates();
            }, 5);
        })->everyMinute();

    }

    // https://gist.github.com/mauris/11375869#gistcomment-1818901
    protected function monitorQueue() {

        $run_command = false;
        $monitor_file_path = storage_path('queue.pid');

        if (file_exists($monitor_file_path)) {
            $pid = file_get_contents($monitor_file_path);
            $result = exec("ps -p $pid --no-heading | awk '{print $1}'");

            if ($result == '') {
                $run_command = true;
            }
        } else {
            $run_command = true;
        }

        if ($run_command) {
            $command = 'php '. base_path('artisan'). ' queue:listen > /dev/null & echo $!';
            $number = exec($command);
            file_put_contents($monitor_file_path, $number);
        }

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
