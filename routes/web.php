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

Auth::routes(['verify' => true]);

Route::get('/auth/redirect/{provider}','SocialAuthController@redirect')->name('redirect');
Route::get('/callback/{provider}','SocialAuthController@callback')->name('callback');

// Page
Route::get('/', 'PageController@index')->name('index')->middleware('verified');

// User
Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::get('show', 'UserController@show')->name('show');
    Route::patch('update', 'UserController@update')->name('update');
});

// Room    
Route::resource('room', 'RoomController',[
    'only' => ['create', 'store', 'update']
]);
Route::group(['prefix' => 'rooms', 'as' => 'room.'], function () {
    Route::get('{room}/listing', 'RoomController@listing')->name('listing');
    Route::get('{room}/pricing', 'RoomController@pricing')->name('pricing');
    Route::get('{room}/description', 'RoomController@description')->name('description');
    Route::get('{room}/photo', 'RoomController@photo')->name('photo');
    Route::get('{room}/amenity', 'RoomController@amenity')->name('amenity');
    Route::get('{room}/location', 'RoomController@location')->name('location');   
});

//Photo
Route::post('rooms/{room}/photos/store', 'PhotoController@store')->name('photo.store');