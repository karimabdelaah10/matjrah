<?php
Route::group(['prefix' => 'users'], function () {
    Route::get('/', '\App\Modules\Users\Controllers\UsersController@getIndex')->name('users');

    Route::get('/create', '\App\Modules\Users\Controllers\UsersController@getCreate');
    Route::post('/create', '\App\Modules\Users\Controllers\UsersController@postCreate');

    Route::get('/edit/{id}', '\App\Modules\Users\Controllers\UsersController@getEdit');
    Route::put('/edit/{id}', '\App\Modules\Users\Controllers\UsersController@postEdit')
        ->name('users.putUser');

    Route::get('/view/{id}', '\App\Modules\Users\Controllers\UsersController@getView')
        ->name('users.view');

    Route::get('/delete/{id}', '\App\Modules\Users\Controllers\UsersController@getDelete')
        ->name('users.delete');

    Route::get('/export', '\App\Modules\Users\Controllers\UsersController@getExport');
});