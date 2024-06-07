<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\FRequestController;
use App\Http\Controllers\api\FriendController;

Route::get('profile/{id?}', [ProfileController::class, 'getAllUserData']);
Route::get('posts/{uid?}', [PostController::class, 'getAllPostOfUser']);
Route::get('post/{id?}', [PostController::class, 'getPostById']);
Route::put('profile/{id}', [ProfileController::class, 'updateUserProfile']);

// Route::middleware('auth:api')->group(function () {
    Route::post('friend-request', [FRequestController::class, 'sendRequest']);
    Route::put('friend-request/respond', [FRequestController::class, 'respondRequest']);
    Route::get('friend-requests/{uid}', [FRequestController::class, 'getRequests']);
// });
Route::get('friends/{uid}', [FriendController::class, 'getFriends']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
