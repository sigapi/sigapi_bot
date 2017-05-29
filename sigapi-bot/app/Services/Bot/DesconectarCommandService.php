<?php

namespace App\Services\Bot;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DesconectarCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('DesconectarCommandService.process - INICIO');

        Log::info("DesconectarCommandService.process: $chatId");

        if (self::hasToken($chatId)) {

            Cache::forget($chatId);
            self::sendMessage($chatId, "✅ Você foi desconectado");
            self::sendMessage($chatId, "👊 Até a próxima");


        } else {

            self::sendMessage($chatId, "🔓 Você não está conectado");

        }

        Log::debug('DesconectarCommandService.process - FIM');

    }

}
