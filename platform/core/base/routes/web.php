<?php

use Bng\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Bng\Base\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'system'], function () {
            Route::get('', [
                'as' => 'system.index',
                'uses' => 'SystemController@index',
                'permission' => 'core.system',
            ]);
        });
    });
});
