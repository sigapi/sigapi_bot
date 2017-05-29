<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class AjudaCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('AjudaCommandService.process - INICIO');
        Log::info("AjudaCommandService.process: $chatId");
        self::sendMessage($chatId, "Ajuda");
        Log::debug('AjudaCommandService.process - FIM');

    }

}
