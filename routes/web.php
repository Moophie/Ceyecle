<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\WebNotificationController;

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

Route::get('/privacy', function () {
    return view('privacy');
});
Route::get('/terms', function () {
    return view('terms');
});

Route::get('/', 'App\Http\Controllers\RaceController@indexRaces')->middleware('auth');

// Signup
Route::get('/register', 'App\Http\Controllers\UserController@signup');
Route::post('/register', 'App\Http\Controllers\UserController@handleSignup');

// Signup with social media
Route::get('/register/facebook', 'App\Http\Controllers\UserController@facebook');
Route::get('/register/facebook/redirect', 'App\Http\Controllers\UserController@facebookRedirect');
Route::get('/register/google', 'App\Http\Controllers\UserController@google');
Route::get('/register/google/redirect', 'App\Http\Controllers\UserController@googleRedirect');
Route::get('/register/twitter', 'App\Http\Controllers\UserController@twitter');
Route::get('/register/twitter/redirect', 'App\Http\Controllers\UserController@twitterRedirect');

// Authentication and sessions (login/logout)
Auth::routes();
Route::get('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\UserController@handleLogin');
Route::get('/logout', 'App\Http\Controllers\UserController@handleLogout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', 'App\Http\Controllers\UserController@profile')->middleware('auth');
Route::get('/editProfile', 'App\Http\Controllers\UserController@editProfile')->middleware('auth');
Route::post('/update', 'App\Http\Controllers\UserController@update')->middleware('auth');

// Social
Route::get('/social', 'App\Http\Controllers\SocialController@social')->middleware('auth');

// Friends
Route::get('/social', function () {
    return view('friends/index');
})->middleware('auth');
Route::get('/friends/search', function () {
    return view('friends/search');
})->middleware('auth');
Route::get('/search', 'App\Http\Controllers\FriendController@search')->middleware('auth');
Route::get('/add/{user}', 'App\Http\Controllers\FriendController@addFriend')->middleware('auth');
Route::get('/user/{user}', 'App\Http\Controllers\FriendController@getFriend')->middleware('auth');
Route::get('/friends/list', function () {
    return view('friends/list');
})->middleware('auth');
Route::get('/friends/accept/{user}', 'App\Http\Controllers\FriendController@acceptRequest')->middleware('auth');

Route::get('/leaderboard', 'App\Http\Controllers\SocialController@leaderboard')->middleware('auth');

// Chat
Route::get('/chat', 'App\Http\Controllers\ChatController@overview')->middleware('auth');
Route::get('/friends/chat/{friend}', 'App\Http\Controllers\ChatController@index')->middleware('auth')->name('chat');
Route::post('/friends/chat', 'App\Http\Controllers\ChatController@sendMessage')->middleware('auth');

// Rooms
Route::get('/rooms', 'App\Http\Controllers\RoomController@index')->middleware('auth');
Route::post('/rooms/create', 'App\Http\Controllers\RoomController@createRoom')->middleware('auth');
Route::get('/rooms/{room}', 'App\Http\Controllers\RoomController@show')->name('show-room')->middleware('auth');
Route::post('/rooms/invite', 'App\Http\Controllers\RoomController@invite')->middleware('auth');
Route::post('/rooms/inviteFriend', 'App\Http\Controllers\RoomController@inviteFriend')->middleware('auth');
Route::post('/rooms/chat', 'App\Http\Controllers\RoomController@sendMessage')->middleware('auth');
Route::get('/rooms/accept/{room}', 'App\Http\Controllers\RoomController@acceptRequest')->middleware('auth');
Route::post('/rooms/raceQuestion', 'App\Http\Controllers\QuestionController@raceQuestion')->middleware('auth');
Route::post('/rooms/riderQuestion', 'App\Http\Controllers\QuestionController@riderQuestion')->middleware('auth');
Route::post('/rooms/answerQuestion', 'App\Http\Controllers\QuestionController@answerQuestion')->middleware('auth');

// Races
Route::get('/races/{race}', 'App\Http\Controllers\RaceController@showRace');

Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
