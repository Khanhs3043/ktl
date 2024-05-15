<?php

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\newct;

Route::get('/',[newct::class,'index']);
