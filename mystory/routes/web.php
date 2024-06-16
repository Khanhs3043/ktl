<?php

use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\PostController;
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
Route::get('home',[ProfileController::class,'index'])->name('home');
Route::get('post/create', function () {
    return view('main.create_post');
});
Route::middleware(['auth'])->group(function () {
    // Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/user/{uid}', [PostController::class, 'userPosts'])->name('posts.user');
    Route::get('posts/create', [PostController::class, 'create']);
    Route::post('posts/create', [PostController::class, 'store'])->name('posts.create');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

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



