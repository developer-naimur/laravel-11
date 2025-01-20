<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/table', [HomeController::class, 'index']);
Route::get('/get-distance', [HomeController::class, 'test']);
Route::get('/get-user-location', [HomeController::class, 'get_current_distance_of_user']);

