<?php

namespace App\Services\Bot;

use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class GetUpdatesService {

    private static function getTelegram() {
        return app('Telegram\Bot\Api');
    }

    public function getUpdates() {

        Log::debug('GetUpdatesService.getUpdates - INICIO');

        $updates = self::getTelegram()->getUpdates(array(
            "offset" => Cache::get('last-message', 0) + 1,
            "limit" => 10,
        ));

        foreach ($updates as $key => $update) {
            dispatch(new ProcessUpdate($update));
            Cache::forever('last-message', $update["update_id"]);
        }

        Log::debug('GetUpdatesService.getUpdates - FIM');

    }

}
