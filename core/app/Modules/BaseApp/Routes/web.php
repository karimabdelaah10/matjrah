<?php

    Route::group(['prefix' => 'Basic'], function () {
        Route::group(['prefix' => 'Ajax'], function () {
            Route::get('filterProjectsByAreaId','AjaxController@filterProjectsByAreaId')->name('filterProjectsByAreaId');
        });
    });
