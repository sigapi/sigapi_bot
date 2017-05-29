<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

abstract class AbstractService {

    protected static function getTelegram() {
        return app('Telegram\Bot\Api');
    }

    protected static function sendMessage($chatId, $message) {

        $response = self::getTelegram()->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);

    }

}
