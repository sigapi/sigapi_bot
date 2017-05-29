<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class NotasParciaisCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('NotasParciaisCommandService.process - INICIO');
        Log::info("NotasParciaisCommandService.process: $chatId");
        self::sendMessage($chatId, "Notas Parciais");
        Log::debug('NotasParciaisCommandService.process - FIM');

    }

}
