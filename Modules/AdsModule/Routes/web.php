<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::prefix('adsmodule')->group(function() {
//    Route::get('/', 'AdsModuleController@index');
//});
Route::group([
    'prefix' => 'dashboard',
], function () {
    Route::group([
        'prefix' => 'users',
        'middleware' => 'auth:admin',
    ], function () {
        Route::get('/', 'UserModuleController@index')->name('getAllUsers');
        Route::get('/create', 'UserModuleController@create')->name('getCreateUser');
        Route::post('/create', 'UserModuleController@store')->name('handleCreateUser');
        Route::get('/edit/{id}', 'UserModuleController@edit')->name('getEditUser');
        Route::put('/edit/{id}', 'UserModuleController@update')->name('handleEditUser');
        Route::get('/delete', 'UserModuleController@delete')->name('deleteUser');
    });
         Route::group([
            'prefix' => 'ads',
            'middleware' => 'auth:admin',
        ], function () {
            Route::get('/', 'AdsModuleController@index')->name('getAllAds');
            Route::get('/create', 'AdsModuleController@create')->name('getCreateAd');
            Route::post('/create', 'AdsModuleController@store')->name('handleCreateAd');
            Route::get('/edit/{id}', 'AdsModuleController@edit')->name('getEditAd');
            Route::put('/edit/{id}', 'AdsModuleController@update')->name('handleEditAd');
            Route::get('/delete', 'AdsModuleController@delete')->name('deleteAd');
        });

});
