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
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('edit', 'UserController@edit')->name('edit');
    Route::get('show', 'UserController@show')->name('show');
    Route::patch('update', 'UserController@update')->name('update');
});

// Room    
Route::resource('rooms', 'RoomController',[
    'only' => ['index', 'create', 'store', 'update']
]);

Route::group(['prefix' => 'rooms', 'as' => 'rooms.'], function () {
    Route::get('{room}/listing', 'RoomController@listing')->name('listing');
    Route::get('{room}/pricing', 'RoomController@pricing')->name('pricing');
    Route::get('{room}/description', 'RoomController@description')->name('description');
    Route::get('{room}/photo', 'RoomController@photo')->name('photo');
    Route::get('{room}/amenity', 'RoomController@amenity')->name('amenity');
    Route::get('{room}/location', 'RoomController@location')->name('location');
    Route::patch('{room}/publish', 'RoomController@publish')->name('publish');
});

//Photo
Route::post('rooms/{room}/photos/store', 'PhotoController@store')->name('photos.store');
Route::delete('photos/{id}', 'PhotoController@destroy')->name('photos.destroy');
