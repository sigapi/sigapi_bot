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
        self::sendMessage($chatId, "Dados de Desempenho");
        Log::debug('DadosDesempenhoCommandService.process - FIM');

    }

}
