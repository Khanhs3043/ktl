<?php

use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback']);
Route::middleware('web')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
 });
 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
    return view('layouts.layout');
});
});
Route::get('profile',[ProfileController::class,'index']);

Route::get('login', function () {
    return view('log.login');
})->name('login');
Route::post('login',[AuthController::class,'login']);
Route::get('register', function () {
    return view('log.register');
});
Route::get('home', function () {
    return view('main.home');
})->name('home');
Route::get('friends', function () {
    return view('main.friend');})->name('friends');

Route::get('groups', function () {
    return view('main.group');
});
Route::get('tasks', function () {
    return view('main.task');
});
Route::get('settings', function () {
    return view('main.setting');
});



