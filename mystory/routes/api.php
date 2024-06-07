<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\FRequestController;

Route::get('profile/{id?}', [ProfileController::class, 'getAllUserData']);
Route::get('posts/{uid?}', [PostController::class, 'getAllPostOfUser']);
Route::get('post/{id?}', [PostController::class, 'getPostById']);
Route::put('profile/{id}', [ProfileController::class, 'updateUserProfile']);

Route::middleware('auth:api')->group(function () {
    Route::post('friend-request', [FRequestController::class, 'sendRequest']);
    Route::patch('friend-request/{id}', [FRequestController::class, 'respondRequest']);
    Route::get('friend-requests', [FRequestController::class, 'getRequests']);
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
