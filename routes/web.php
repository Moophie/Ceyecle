<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App\Http\Controllers\EventController@upcomingEvents')->middleware('auth');

// Signup
Route::get('/signup', 'App\Http\Controllers\UserController@signup');
Route::post('/signup', 'App\Http\Controllers\UserController@handleSignup');

// Authentication and sessions (login/logout)
Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@handleLogin');
Route::get('/logout', 'App\Http\Controllers\UserController@handleLogout');

// Profile
Route::get('/profile', 'App\Http\Controllers\UserController@profile')->middleware('auth');
Route::get('/editProfile', 'App\Http\Controllers\UserController@editProfile')->middleware('auth');
Route::post('/update', 'App\Http\Controllers\UserController@update')->middleware('auth');

// Social
Route::get('/social', 'App\Http\Controllers\SocialController@social')->middleware('auth');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Friends
Route::get('/social', function () {
    return view('friends/index');
})->middleware('auth');
Route::get('/friends/search', function () {
    return view('friends/search');
})->middleware('auth');
Route::get('/search', 'App\Http\Controllers\FriendController@search')->middleware('auth');
Route::get('/friends/list', function () {
    return view('friends/list');
})->middleware('auth');
Route::get('/leaderboard', function () {
    return view('friends/leaderboards');
})->middleware('auth');
Route::get('/add/{user}', 'App\Http\Controllers\FriendController@addFriend')->middleware('auth');

// Rooms
Route::get('/rooms/index', 'App\Http\Controllers\RoomController@index')->middleware('auth');
Route::post('/rooms/create', 'App\Http\Controllers\RoomController@createRoom')->middleware('auth');
Route::get('/rooms/{room}', 'App\Http\Controllers\RoomController@show')->name('show-room')->middleware('auth');
Route::post('/rooms/invite', 'App\Http\Controllers\RoomController@invite')->middleware('auth');
Route::post('/rooms/inviteFriend', 'App\Http\Controllers\RoomController@inviteFriend')->middleware('auth');
Route::post('/rooms/chat', 'App\Http\Controllers\RoomController@sendMessage')->middleware('auth');
