<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Services\Bot\AutorizacaoService;

class AutorizacaoController extends Controller {

    public function get() {

        $chatId = Input::get("chatId");
        $authorizationCode = Input::get("code");

        $result = (new AutorizacaoService())->process($chatId, $authorizationCode);
        return "A comunicação daqui em diante será feita pelo Telegram";

    }

}
