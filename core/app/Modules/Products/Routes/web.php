<?php

Route::group([
    'middleware' => ['auth']
], function () {
    Route::group(['prefix' => '/dashboard/products' , 'as' => 'products.'], function () {
        Route::get('/', 'ProductsController@getIndex');

        Route::get('/create', 'ProductsController@getCreate');
        Route::post('/create', 'ProductsController@postCreate');

        Route::get('/edit/{id}', 'ProductsController@getEdit');
        Route::put('/edit/{id}', 'ProductsController@postEdit');

        Route::get('/view/{id}', 'ProductsController@getView');
        Route::get('/delete/{id}', 'ProductsController@getDelete')->name('delete');
    });
});
