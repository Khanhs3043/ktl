<?php

use App\Http\Controllers\HelloWorld;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('hello',[HelloWorld::class, 'index']);