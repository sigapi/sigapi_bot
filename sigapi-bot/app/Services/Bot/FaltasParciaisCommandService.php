<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class FaltasParciaisCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('FaltasParciaisCommandService.process - INICIO');
        Log::info("FaltasParciaisCommandService.process: $chatId");
        self::sendMessage($chatId, "Faltas Parciais");
        Log::debug('FaltasParciaisCommandService.process - FIM');

    }

}
