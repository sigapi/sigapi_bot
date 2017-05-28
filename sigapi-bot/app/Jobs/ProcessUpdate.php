<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;
use Telegram\Bot\Api;

class ProcessUpdate implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    protected $update;

    public function __construct(Update $update) {
        $this->update = $update;
        Log::info('Criando job: ' . $this->update["update_id"]);
    }

    public function handle(Api $telegram) {

        $updateId = $this->update["update_id"];
        Log::info('Iniciando: ' . $updateId);

        $message = $this->update["message"];
        $from = $message["from"];
        $chat = $message["chat"];

        $messageId = $message["message_id"];
        $chatId = $chat["id"];
        $text = $message["text"];

        $response = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "Resposta para a mensagem '$messageId' no chat '$chatId' com o texto '$text'"
        ]);

        $messageId = $response->getMessageId();

        Log::info('Finalizando: ' . $updateId);


    }
}
