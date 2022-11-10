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

    Route::group(['prefix' => 'admins'],function (){
        Route::post('/login','AdminApiController@login');
        Route::get('/','AdminApiController@index');//->middleware('auth:admin_api');
        Route::post('/register','AdminApiController@create');//->middleware('auth:admin_api');
        Route::get('/{id}','AdminApiController@find');//->middleware('auth:admin_api');
        Route::delete('/{id}','AdminApiController@delete');//->middleware('auth:admin_api');
    });
});
