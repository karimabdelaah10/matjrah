<?php

use App\Modules\Company\Controllers\CompanyController;
use App\Modules\Company\Controllers\Web\CompanyWebController;

Route::group([
    'middleware' => ['auth']
], function () {
    Route::group(['prefix' => '/dashboard/companies', 'as' => 'companies.'], function () {
        Route::get('/', [CompanyController::class, 'getIndex']);

        Route::get('/create', [CompanyController::class, 'getCreate']);
        Route::post('/create', [CompanyController::class, 'postCreate']);

        Route::get('/edit/{id}', [CompanyController::class, 'getEdit']);
        Route::put('/edit/{id}', [CompanyController::class, 'postEdit']);

        Route::get('/delete/{id}', [CompanyController::class, 'getDelete'])->name('delete');
    });
});

//Route::get('company_login/{subdomain}',[CompanyWebController::class , 'getLogin']);
//Route::post('company_login/{subdomain}',[CompanyWebController::class , 'postLogin']);
