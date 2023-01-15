<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostController as apiPostController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route
Route::post('/login', [AuthController::class, 'login'])->name('login.api');
Route::post('/register', [AuthController::class, 'register'])->name('register.api');

//protracted route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::resource('/post', apiPostController::class);
    // Route::resource('post', PostController::class)->parameter('post', 'post:slug');
});

Route::resource('/user', UserController::class)->parameter('user', 'user:slug');
