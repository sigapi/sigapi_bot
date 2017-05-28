<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DebugController extends Controller {

    public function saveInCache() {
        Cache::put('test', 'ok', 10);
    }

    public function getFromCache() {
        Log::info('Testando cache');

        if (Cache::has('test')) {
            dump(Cache::get('test'));
        } else {
            dump("Não existe no cache");
        }
    }

}
