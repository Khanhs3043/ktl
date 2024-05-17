<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\linhctl;

Route::get('/', [linhctl::class, 'index']);
