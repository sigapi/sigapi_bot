<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class DadosCadastraisCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('DadosCadastraisCommandService.process - INICIO');
        Log::info("DadosCadastraisCommandService.process: $chatId");

        if (self::hasToken($chatId)) {
            self::sendMessage($chatId, "🗿 Já já");
        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado");
        }

        Log::debug('DadosCadastraisCommandService.process - FIM');

    }

}
