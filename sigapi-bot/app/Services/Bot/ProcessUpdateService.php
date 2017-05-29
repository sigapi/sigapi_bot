<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class ProcessUpdateService extends AbstractService {

    public function process(Update $update) {

        Log::debug('ProcessUpdateService.process - INICIO');

        $updateId = $update["update_id"];

        $message = $update["message"];
        $from = $message["from"];
        $chat = $message["chat"];

        $messageId = $message["message_id"];
        $chatId = $chat["id"];
        $text = $message["text"];

        Log::info("ProcessUpdateService.process - Processando update $updateId com o texto '$text'");

        switch (trim(strtolower($text))) {

            case "/ajuda":
            case "/help":
                (new AjudaCommandService())->process($chatId);
                break;

            case "/start":
            case "/conectar":
                (new ConectarCommandService())->process($chatId);
                break;

            case "/stop":
            case "/desconectar":
                (new DesconectarCommandService())->process($chatId);
                break;

            case "/dados_cadastrais":
                (new DadosCadastraisCommandService())->process($chatId);
                break;

            case "/dados_desempenho":
                (new DadosDesempenhoCommandService())->process($chatId);
                break;

            case "/notas_parciais":
                (new NotasParciaisCommandService())->process($chatId);
                break;

            case "/faltas_parciais":
                (new FaltasParciaisCommandService())->process($chatId);
                break;

            default:
                self::sendMessage($chatId, "Não conheço esse comando 👎");
        }

        Log::debug('ProcessUpdateService.process - FIM');

    }

}
