<?php

use App\Http\Controllers\web\GroupController;
use App\Http\Controllers\web\FriendController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\SearchController;
use App\Http\Controllers\web\FRequestController;
use App\Http\Controllers\web\TaskController;
use Illuminate\Support\Facades\Route;
// use Laravel\Socialite\Facades\Socialite;

//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('register', function () {
    return view('auth.register');
});

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

//Need to log in to use
Route::middleware(['auth'])->group(function () {
    Route::get('home',[ProfileController::class,'index'])->name('home');
    Route::get('post/create', function () {
        return view('main.create_post');
    });
    //search
    Route::get('search', function () {
        return view('main.search_user');
    });
    Route::post('search',[SearchController::class,'searchUsers']);

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
    //profile
    Route::get('profile',[ProfileController::class,'index']);
    Route::get('profile/{id}',[ProfileController::class,'showProfile']);

    //group
    Route::get('groups', [GroupController::class,'myGroups']);
    Route::post('groups/create', [GroupController::class,'create']);
    Route::post('groups/delete/{id}', [GroupController::class,'delete']);
    Route::post('groups/update/{id}', [GroupController::class,'update']);
    Route::get('group/update/{id}', [GroupController::class,'showUpdateView']);
    Route::get('group/{id}', [GroupController::class,'groupDetails']);
    Route::post('group/remove_member/{groupId}/{uid}', [GroupController::class,'removeMember']);

    //task
    Route::post('tasks/create', [TaskController::class,'store']);
    Route::get('tasks/create', [TaskController::class,'create']);
    Route::get('tasks', [TaskController::class,'index']);
});


//-------------------not yet ------------
Route::get('settings', function () {
    return view('main.setting');
});



