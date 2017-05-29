<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class DadosDesempenhoCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('DadosDesempenhoCommandService.process - INICIO');
        Log::info("DadosDesempenhoCommandService.process: $chatId");

        if (self::hasToken($chatId)) {
            self::sendMessage($chatId, "🗿 Já já");
        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado");
        }

        Log::debug('DadosDesempenhoCommandService.process - FIM');

    }

}
