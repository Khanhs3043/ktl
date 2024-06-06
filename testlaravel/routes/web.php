<?php

use App\Http\Controllers\HelloWorld;
use App\Http\Controllers\Data;
use App\Http\Controllers\ShowData;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('hello',[HelloWorld::class, 'index']);
Route::get('showdata',[ShowData::class, 'index']);