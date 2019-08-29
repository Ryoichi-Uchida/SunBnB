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

Auth::routes();

// Page
Route::get('/', 'PageController@index')->name('index');

// User
Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::patch('update', 'UserController@update')->name('update');
});
