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
        self::sendMessage($chatId, "Dados Cadastrais");
        Log::debug('DadosCadastraisCommandService.process - FIM');

    }

}
