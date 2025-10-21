<?php

use Bng\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Bng\Dashboard\Http\Controllers'], function () {
  AdminHelper::registerRoutes(function () {
    Route::get('', [
      'as' => 'dashboard.index',
      'uses' => 'DashboardController@getDashboard',
      'permission' => false,
    ]);
  });
});
