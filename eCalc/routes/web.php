<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;
use App\Http\Controllers\CostController;
// Route::get('/', function () {
//     return view('calc');
// });
Route::get('/', [CalcController::class, 'index']);
Route::get('cost', [CostController::class, 'index']);
Route::get('calc', [CalcController::class, 'index']);
Route::post('calc', [CalcController::class, 'calc'])->name('calc');;
