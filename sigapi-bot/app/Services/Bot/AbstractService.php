<?php

namespace App\Services\Bot;

use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Api;

abstract class AbstractService {

    protected static function getTelegram() {
        return app('Telegram\Bot\Api');
    }

    protected static function sendMessage($chatId, $message) {

        $response = self::getTelegram()->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => "markdown",
            'disable_web_page_preview' => true
        ]);

    }

    protected static function hasToken($chatId) {
        return Cache::has($chatId);
    }

}
