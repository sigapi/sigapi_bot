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

            $response = self::getClient($chatId)->get("notas-parciais");
            if ($response->getStatusCode() == 200) {

                $message = "📋 *Notas Parciais*\n";
                $message .= "_As disciplinas que não possuem informações registradas não serão exibidas_\n\n";

                $body = $response->getBody()->getContents();
                $jsonResult = json_decode($body);

                foreach($jsonResult as $registro) {

                    $avaliacoes = $registro->avaliacoes;
                    $array =  (array) $avaliacoes;

                    if (count($array) > 0) {

                        $message .= "*$registro->siglaDisciplina - $registro->nomeDisciplina: *\n";

                        ksort($array);
                        foreach($array as $tipo => $nota) {
                            $message .= "◾ $tipo: " . number_format($nota, 2, ",", ".") . "\n";
                        }

                        $message .= "\n";

                    }

                }

                self::sendMessage($chatId, $message);

            } else {
                self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro");
            }

        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado");
        }

        Log::debug('NotasParciaisCommandService.process - FIM');

    }

}
