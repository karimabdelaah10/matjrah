<?php

use App\Modules\Company\Controllers\Web\CompanyWebController;

Route::get('/',[CompanyWebController::class , 'getLogin']);
Route::post('/',[CompanyWebController::class , 'postLogin']);
