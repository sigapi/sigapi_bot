<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class DebugController extends Controller {

    public function saveInCache() {
        Cache::put('test', 'ok', 10);
    }

    public function getFromCache() {
        if (Cache::has('test')) {
            dump(Cache::get('test'));
        } else {
            dump("Não existe no cache");
        }
    }

}
