<?php

use Bng\Acp\Http\Controllers\Auth\LoginController;
use Bng\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Bng\Acp\Http\Controllers'], function () {
  AdminHelper::registerRoutes(function () {
    Route::group(['middleware' => 'guest'], function () {
      Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
      Route::post('login', [LoginController::class, 'login'])->name('access.login');
    });
  }, ['web', 'core']);
  AdminHelper::registerRoutes(function () {
    Route::get('logout', [
      'as' => 'access.logout',
      'uses' => 'Auth\LoginController@logout',
      'permission' => false,
    ]);
    Route::group(['prefix' => 'system'], function () {
      Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('', 'UserController')->except(['update'])->parameters(['' => 'user']);

        Route::get('make-super/{user}', [
          'as' => 'make-super',
          'uses' => 'UserController@makeSuper',
          'permission' => 'superuser',
        ]);

        Route::get('remove-super/{user}', [
          'as' => 'remove-super',
          'uses' => 'UserController@removeSuper',
          'permission' => 'superuser',
        ]);

        Route::put('profile/{user}', [
          'as' => 'update-profile',
          'uses' => 'UserController@updateProfile',
          'permission' => false,
        ]);

        Route::put('password/{user}', [
          'as' => 'update-password',
          'uses' => 'UserController@updatePassword',
          'permission' => false,
        ]);
      });
    });
  });
});
