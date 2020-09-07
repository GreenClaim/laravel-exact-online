<?php

Route::group(['prefix' => 'exact', 'middleware' => config('laravel-exact-online.exact_multi_user') ? ['web','auth'] : ['web'] ], function() {
    Route::get('connect', ['as' => 'exact.connect', 'uses' => 'Yource\LaravelExactOnline\Http\Controllers\LaravelExactOnlineController@appConnect']);
    Route::post('authorize', ['as' => 'exact.authorize', 'uses' => 'Yource\LaravelExactOnline\Http\Controllers\LaravelExactOnlineController@appAuthorize']);
    Route::get('oauth', ['as' => 'exact.callback', 'uses' => 'Yource\LaravelExactOnline\Http\Controllers\LaravelExactOnlineController@appCallback']);
});
