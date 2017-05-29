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

        if (self::hasToken($chatId)) {
            self::sendMessage($chatId, "🗿 Já já");
        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado");
        }

        Log::debug('NotasParciaisCommandService.process - FIM');

    }

}
