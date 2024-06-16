<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\FRequestController;
use App\Http\Controllers\api\FriendController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\GroupController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\AppointmentController;

Route::get('profile/{id?}', [ProfileController::class, 'getAllUserData']);
Route::get('posts/{uid?}', [PostController::class, 'getAllPostOfUser']);
Route::get('post/{id?}', [PostController::class, 'getPostById']);
Route::put('profile/{id}', [ProfileController::class, 'updateUserProfile']);

Route::middleware('auth:sanctum')->group(function () {
    //friend-request
    Route::post('friend-request/{uid}', [FRequestController::class, 'sendRequest']);
    Route::put('friend-request/respond/{id}', [FRequestController::class, 'respondRequest']);
    Route::get('friend-requests/{uid}', [FRequestController::class, 'getRequests']);
    Route::get('friend-requests', [FRequestController::class, 'getMyRequests']);
    Route::get('{uid}/friend-requests', [FRequestController::class, 'getUserFriendRequests']);
    //friend
    Route::get('friends', [FriendController::class, 'getFriends']);
    Route::get('search-users', [FriendController::class, 'searchUsers']);
    Route::get('search-friends/{userId}', [FriendController::class, 'searchFriends']);
    //group
    Route::post('groups', [GroupController::class, 'create']);
    Route::post('groups/{groupId}/add-user', [GroupController::class, 'addUserToGroup']);
    Route::get('groups', [GroupController::class, 'getGroups']);
    Route::get('mygroups', [GroupController::class, 'myGroups']);
    Route::get('groupusers/{groupId}', [GroupController::class, 'groupUsers']);

    //post
    Route::get('myPosts', [PostController::class, 'getAllMyPosts']);
    Route::post('posts/create', [PostController::class, 'store']);
    Route::post('posts/delete/{id}', [PostController::class, 'delete']);
    Route::put('posts/update/{id}', [PostController::class, 'update']);

    //task
    Route::get('tasks', [TaskController::class, 'tasks']);
    Route::post('tasks/create', [TaskController::class, 'store']);
    Route::put('tasks/update/{taskId}', [TaskController::class, 'update']);
    Route::post('tasks/delete/{taskId}', [TaskController::class, 'delete']);

    //appointment
    Route::get('appointments', [AppointmentController::class, 'appointments']);
    Route::post('appointments/create', [AppointmentController::class, 'store']);
    Route::get('appointments/{id}', [AppointmentController::class, 'show']);
    Route::put('appointments/update/{id}', [AppointmentController::class, 'update']);
    Route::post('appointments/delete/{id}', [AppointmentController::class, 'delete']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
//Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
