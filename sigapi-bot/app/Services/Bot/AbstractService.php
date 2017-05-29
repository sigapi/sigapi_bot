<?php

namespace App\Services\Bot;

use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Api;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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

    protected static function getClient($chatId) {
        return new Client([
            'base_uri' => 'http://api.sigapi.info/api/',
            'timeout' => 0,
            'headers' => [
                'Authorization' => 'Bearer ' . Cache::get($chatId)
            ]
        ]);
    }


}
