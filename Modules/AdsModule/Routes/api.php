<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '','namespace' => 'Api'],function (){
    Route::group(['prefix' => 'ads'],function (){
        Route::post('/create','AdApiController@create');//->middleware('auth:admin_api');
        Route::post('/{id}','AdApiController@update');//->middleware('auth:admin_api');;
        Route::put('/active/{id}','AdApiController@updateActivity');//->middleware('auth:admin_api');;
        Route::get('/','AdApiController@index');//->middleware('auth:admin_api');
        Route::get('/{id}','AdApiController@find');//->middleware('auth:admin_api');
        Route::delete('/{id}','AdApiController@delete');//->middleware('auth:admin_api');
    });
    Route::group(['prefix' => 'users'],function (){
        Route::put('/{id}','UserApiController@update');//->middleware('auth:admin_api');;
        Route::put('/active/{id}','UserApiController@updateActivity');//->middleware('auth:admin_api');;
        Route::get('/','UserApiController@index');//->middleware('auth:admin_api');
        Route::post('/create','UserApiController@create');//->middleware('auth:admin_api');
        Route::get('/{id}','UserApiController@find');//->middleware('auth:admin_api');
        Route::delete('/{id}','UserApiController@delete');//->middleware('auth:admin_api');
    });
});
