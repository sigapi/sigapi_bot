<?php

Route::get('debug/cache/save', 'DebugController@saveInCache');
Route::get('debug/cache/get', 'DebugController@getFromCache');

Route::get('/', function () {
    return view('welcome');
});
