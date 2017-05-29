<?php

Route::get('debug/cache/save', 'DebugController@saveInCache');
Route::get('debug/cache/get', 'DebugController@getFromCache');
Route::get('autorizacao', 'AutorizacaoController@get')->name('autorizacao');

Route::get('/', function () {
    return view('welcome');
});
