<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class DesconectarCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('DesconectarCommandService.process - INICIO');
        Log::info("DesconectarCommandService.process: $chatId");
        self::sendMessage($chatId, "Desconectar");
        Log::debug('DesconectarCommandService.process - FIM');

    }

}
