<?php

namespace App\Services\Bot;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ConectarCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('ConectarCommandService.process - INICIO');

        Log::info("ConectarCommandService.process: $chatId");
        if (self::hasToken($chatId)) {

            self::sendMessage($chatId, "🔒 Você já está conectado");

        } else {

            $redirectUrl = route('autorizacao', [
                'chatId' => $chatId
            ]);

            $authorizationUrl = "http://login.sigapi.info/oauth/authorize?client_id=exemplo&redirect_uri=$redirectUrl&response_type=code";

            $message = "⚠ É necessário que você nos dê permissão de acesso aos seus dados no *sigapi* acessando [esse link]($authorizationUrl)";
            self::sendMessage($chatId, $message);

        }

        Log::debug('ConectarCommandService.process - FIM');

    }

}
