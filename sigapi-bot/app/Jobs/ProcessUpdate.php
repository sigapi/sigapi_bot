<?php

namespace App\Jobs;

use App\Services\Bot\ProcessUpdateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class ProcessUpdate implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    protected $update;

    public function __construct(Update $update) {
        $this->update = $update;
        Log::debug('ProcessUpdate.__construct: ' . $this->update["update_id"]);
    }

    public function handle() {
        (new ProcessUpdateService())->process($this->update);
    }
}
