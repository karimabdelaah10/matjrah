<?php
Route::get('/register', '\App\Modules\Users\Controllers\AuthController@getRegister');
Route::post('/register', '\App\Modules\Users\Controllers\AuthController@postRegister');

Route::get('/login', '\App\Modules\Users\Controllers\AuthController@getLogin')->name('login');
Route::post('/login', '\App\Modules\Users\Controllers\AuthController@postLogin');

Route::get('/forgot-password', '\App\Modules\Users\Controllers\AuthController@getForgotPassword');
Route::post('/forgot-password', '\App\Modules\Users\Controllers\AuthController@postForgotPassword');

Route::get('/confirm', '\App\Modules\Users\Controllers\AuthController@getConfirm');
Route::get('/logout', '\App\Modules\Users\Controllers\AuthController@getLogout')->name('get.logout');
