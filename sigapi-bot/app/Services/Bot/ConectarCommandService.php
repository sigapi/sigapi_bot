<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class ConectarCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('ConectarCommandService.process - INICIO');
        Log::info("ConectarCommandService.process: $chatId");
        self::sendMessage($chatId, "Conectar");
        Log::debug('ConectarCommandService.process - FIM');

    }

}
