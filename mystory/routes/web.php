<?php

use App\Http\Controllers\web\ProfileController;
use Illuminate\Support\Facades\Route;
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

