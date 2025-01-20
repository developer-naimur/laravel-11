<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


Route::post('/user/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

	Route::resource('permission', PermissionController::class);

	Route::post('role/{id}', [RoleController::class, 'update']);
	Route::resource('role', RoleController::class);

	Route::post('user/{id}', [UserController::class, 'update']);
	Route::resource('user', UserController::class);

});


