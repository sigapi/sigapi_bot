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

                $message = "📊 *Dados de Desempenho*\n";
                $message .= "_O Maior PR do Curso não é exibido caso esteja indisponível_\n\n";

                $message .= "*PP*: " . number_format($jsonResult->pp, 2, ",", ".") . "\n";
                $message .= "*PR*: " . number_format($jsonResult->pr, 2, ",", ".") . "\n";
                if ($jsonResult->maiorPrCurso > 0) {
                    $message .= "*Maior PR do Curso*: " . number_format($jsonResult->maiorPrCurso, 2, ",", ".") . "\n";
                }

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
