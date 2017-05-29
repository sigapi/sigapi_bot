<?php

namespace App\Services\Bot;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DadosDesempenhoCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('DadosDesempenhoCommandService.process - INICIO');
        Log::info("DadosDesempenhoCommandService.process: $chatId");

        if (self::hasToken($chatId)) {

            $response = self::getClient($chatId)->get("dados-desempenho");

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody()->getContents();
                $jsonResult = json_decode($body);

                $message = "📊 *Dados de Desempenho*\n\n";
                $message .= "*PP*: $jsonResult->pp\n";
                $message .= "*PR*: $jsonResult->pr\n";
                $message .= "*Maior PR do Curso*: $jsonResult->maiorPrCurso\n";

                self::sendMessage($chatId, $message);
            } else {
                self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro");
            }

        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado. Use /conectar.");
        }

        Log::debug('DadosDesempenhoCommandService.process - FIM');

    }

}
