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
    Route::group(['prefix' => 'countries'],function (){
        Route::put('/{id}','CountryApiController@update');//->middleware('auth:admin_api');;
        Route::get('/','CountryApiController@index');//->middleware('auth:admin_api');
        Route::post('/create','CountryApiController@create');//->middleware('auth:admin_api');
        Route::get('/{id}','CountryApiController@find');//->middleware('auth:admin_api');
        Route::delete('/{id}','CountryApiController@delete');//->middleware('auth:admin_api');
    });
    Route::group(['prefix' => 'cities'],function (){
        Route::put('/{id}','CityApiController@update');//->middleware('auth:admin_api');;
        Route::get('/','CityApiController@index');//->middleware('auth:admin_api');
        Route::post('/create','CityApiController@create');//->middleware('auth:admin_api');
        Route::get('/{id}','CityApiController@find');//->middleware('auth:admin_api');
        Route::delete('/{id}','CityApiController@delete');//->middleware('auth:admin_api');
    });
});
