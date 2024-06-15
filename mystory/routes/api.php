<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\FRequestController;
use App\Http\Controllers\api\FriendController;
use App\Http\Controllers\api\AuthController;

Route::get('profile/{id?}', [ProfileController::class, 'getAllUserData']);
Route::get('posts/{uid?}', [PostController::class, 'getAllPostOfUser']);
Route::get('post/{id?}', [PostController::class, 'getPostById']);
Route::put('profile/{id}', [ProfileController::class, 'updateUserProfile']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('friend-request/{uid}', [FRequestController::class, 'sendRequest']);
    Route::put('friend-request/respond/{id}', [FRequestController::class, 'respondRequest']);
    Route::get('friend-requests/{uid}', [FRequestController::class, 'getRequests']);
    Route::get('friends', [FriendController::class, 'getFriends']);
    Route::get('search-users', [FriendController::class, 'searchUsers']);
    Route::get('search-friends/{userId}', [FriendController::class, 'searchFriends']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
