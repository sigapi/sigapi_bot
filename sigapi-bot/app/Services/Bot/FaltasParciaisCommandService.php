<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class FaltasParciaisCommandService extends AbstractService {

    public function process($chatId) {

        Log::debug('FaltasParciaisCommandService.process - INICIO');
        Log::info("FaltasParciaisCommandService.process: $chatId");

        if (self::hasToken($chatId)) {

            $response = self::getClient($chatId)->get("faltas-parciais");
            if ($response->getStatusCode() == 200) {

                $message = "⌛ *Faltas Parciais*\n";
                $message .= "_As disciplinas que não possuem informações registradas não serão exibidas_\n\n";

                $body = $response->getBody()->getContents();
                $jsonResult = json_decode($body);

                foreach($jsonResult as $registro) {
                    if ($registro->quantidadePresencas > 0 || $registro->quantidadeAusencias > 0) {
                        $message .= "*$registro->siglaDisciplina - $registro->nomeDisciplina*\n";
                        $message .= "◾ $registro->quantidadePresencas presenças e $registro->quantidadeAusencias faltas\n\n";
                    }
                }

                self::sendMessage($chatId, $message);

            } else {
                self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro");
            }

        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado");
        }

        Log::debug('FaltasParciaisCommandService.process - FIM');

    }

}
