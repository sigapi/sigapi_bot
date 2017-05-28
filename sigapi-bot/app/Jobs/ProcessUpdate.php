<?php

namespace App\Jobs;

use App\Podcast;
use App\AudioProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class ProcessUpdate implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    protected $update;

    public function __construct(Update $update) {
        Log::info('Construtor');
        $this->update = $update;
    }

    public function handle() {
        Log::info('Execução:' . $this->update["update_id"]);
    }
}
