<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Jobs\ProcessUpdate;
use Illuminate\Support\Facades\Cache;

/**
 * Class BotController
 */
class BotController extends Controller
{
    protected $telegram;

    public function __construct(Api $telegram) {
        $this->telegram = $telegram;
    }

    public function getUpdates() {

        $updates = $this->telegram->getUpdates(array(
            "offset" => Cache::get('last-message', 0) + 1,
            "limit" => 10,
        ));

        foreach ($updates as $key => $update) {
            dispatch(new ProcessUpdate($update));
            Cache::forever('last-message', $update["update_id"]);
        }

    }

}
