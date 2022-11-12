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

Route::prefix('')->group(function() {
    Route::get('login', 'AuthController@index')->name('login');
    Route::post('post-login', 'AuthController@handleLoginAdmin')->name('login.post');
    Route::get('logout', 'AuthController@handleLogoutAdmin')->name('logout');
    Route::get('/', 'AuthController@dashboard')->name('getDashboardHome');

}
    );
