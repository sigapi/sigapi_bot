<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Jobs\ProcessUpdate;
use Carbon\Carbon;

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

        $updates = $this->telegram->getUpdates();

        foreach ($updates as $key => $update) {
            $job = (new ProcessUpdate($update))->delay(Carbon::now()->addSeconds(10));
            dispatch($job);
        }

    }

}
