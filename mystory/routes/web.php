<?php

use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('profile',[ProfileController::class,'index']);
Route::get('/', function () {
    return view('layouts.layout');
});
Route::get('home', function () {
    return view('main.home');
});
Route::get('friends', function () {
    return view('main.friend');
});

Route::get('groups', function () {
    return view('main.group');
});
Route::get('tasks', function () {
    return view('main.task');
});
Route::get('settings', function () {
    return view('main.setting');
});

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
