<?php

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth']
], function () {
    Route::group([
    ], function () {
        Route::get('/', 'DashboardController@getIndex')->name('dashboard.index');
    });
});