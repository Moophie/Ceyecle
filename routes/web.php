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

Route::get('/', function () {
    return view('index');
})->middleware('auth');

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
Route::post('/uploadPicture', 'App\Http\Controllers\UserController@uploadPicture')->middleware('auth');
Route::post('/updateInfo', 'App\Http\Controllers\UserController@updateInfo')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
