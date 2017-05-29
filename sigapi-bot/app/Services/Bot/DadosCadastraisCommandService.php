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

            $response = self::getClient($chatId)->get("dados-cadastrais");

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody()->getContents();
                $jsonResult = json_decode($body);

                $message = "🎓 *Dados Cadastrais*\n\n";
                $message .= "*Nome*: $jsonResult->nome\n";
                $message .= "*RA*: $jsonResult->ra\n";
                $message .= "*Instituição*: $jsonResult->instituicao\n";
                $message .= "*Curso*: $jsonResult->curso\n";
                $message .= "*Turno*: $jsonResult->turno\n";

                self::sendMessage($chatId, $message);
            } else {
                self::sendMessage($chatId, "🚫 Infelizmente ocorreu um erro");
            }

        } else {
            self::sendMessage($chatId, "🔓 Você não está conectado. Use /conectar.");
        }
        Log::debug('DadosCadastraisCommandService.process - FIM');

    }

}
