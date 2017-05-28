<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Inspiring;
use Telegram\Bot\Api;

/**
 * Class BotController
 */
class BotController extends Controller
{
    /** @var Api */
    protected $telegram;

    /**
     * BotController constructor.
     *
     * @param Api $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Get updates from Telegram.
     */
    public function getUpdates()
    {
        $updates = $this->telegram->getUpdates();
        foreach ($updates as $key => $value) {
            $updateId = $value["update_id"];
            $message = $value["message"];
            $from = $message["from"];
            $chat = $message["chat"];

            $messageId = $message["message_id"];
            $chatId = $chat["id"];
            $text = $message["text"];

            dump($messageId, $chatId, $text);
            //
            // $response = $this->telegram->sendMessage([
            //     'chat_id' => $chatId,
            //     'text' => "Resposta para a mensagem '$messageId' no chat '$chatId' com o texto '$text'"
            // ]);
            //
            // $messageId = $response->getMessageId();

        }

        die();

        // Do something with the updates
    }

}
