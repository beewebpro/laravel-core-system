<?php

use Bng\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Bng\Media\Http\Controllers'], function () {
  Route::get('media/files/{hash}/{id}', [
    'as' => 'media.indirect.url',
    'uses' => 'MediaController@show',
    'middleware' => 'throttle',
  ]);

  AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'media', 'as' => 'media.', 'permission' => 'media.index'], function () {
      Route::get('', [
        'as' => 'index',
        'uses' => 'MediaController@getMedia',
      ]);

      Route::get('popup', [
        'as' => 'popup',
        'uses' => 'MediaController@getPopup',
      ]);

      Route::get('list', [
        'as' => 'list',
        'uses' => 'MediaController@getList',
      ]);

      Route::get('breadcrumbs', [
        'as' => 'breadcrumbs',
        'uses' => 'MediaController@getBreadcrumbs',
      ]);

      Route::post('global-actions', [
        'as' => 'global_actions',
        'uses' => 'MediaController@postGlobalActions',
      ]);

      Route::post('download', [
        'as' => 'download',
        'uses' => 'MediaController@download',
      ]);
    });
  });
});
