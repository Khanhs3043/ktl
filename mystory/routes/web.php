<?php

use App\Http\Controllers\web\FriendController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\SearchController;
use App\Http\Controllers\web\FRequestController;
use App\Models\FRequest;
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
Route::get('profile/{id}',[ProfileController::class,'showProfile']);
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('search', function () {
    return view('main.search_user');
});
Route::post('search',[SearchController::class,'searchUsers']);

Route::post('login',[AuthController::class,'login']);
Route::get('register', function () {
    return view('auth.register');
});



Route::middleware(['auth'])->group(function () {
    Route::get('home',[ProfileController::class,'index'])->name('home');
    Route::get('post/create', function () {
        return view('main.create_post');
    });
    // Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/user/{uid}', [PostController::class, 'userPosts'])->name('posts.user');
    Route::get('posts/create', [PostController::class, 'create']);
    Route::post('posts/create', [PostController::class, 'store'])->name('posts.create');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    //friend-request
    Route::post('send-request/{id}', [FRequestController::class, 'sendRequest']);
    Route::delete('cancel-request/{userId}', [FRequestController::class, 'deleteRequest'])->name('friend-request.delete');
    Route::get('friends', [FriendController::class,'getFriends']);
    Route::get('requests', [FRequestController::class,'getRequests']);
    Route::post('/request/respond/{id}', [FRequestController::class, 'respondRequest']);
    Route::post('/unfriend/{id}',[FriendController::class,'unfriend']);
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



