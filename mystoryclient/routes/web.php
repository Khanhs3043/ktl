<?php

use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('profile',[ProfileController::class,'index']);
Route::get('/', function () {
    return view('layouts.layout');
});
Route::get('login', function () {
    return view('log.login');
});
Route::post('login',[AuthController::class,'login']);
Route::get('register', function () {
    return view('log.register');
});
Route::get('home', function () {
    $user = Socialite::driver('google')->user();
    return view('main.home',compact('user'));
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

Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
