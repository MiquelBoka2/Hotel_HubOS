<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('hotels','HotelController');
    Route::resource('rooms','RoomController');
    Route::get('/rooms/rooms_hotel/{hotel_id}','RoomController@roomsFromHotel')->name('hotels.rooms');
    Route::get('/rooms/create/{hotel_id}','RoomController@createFromHotel')->name('rooms.create_hotel');
    Route::get('/rooms/{id}/edit/{hotel_id}','RoomController@editFromHotel')->name('rooms.edit_hotel');
    Route::delete('/rooms/{id}/{hotel_id}','RoomController@destroyFromHotel')->name('rooms.destroy_hotel');
});
