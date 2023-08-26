<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware('guest')->group(function(){
    Route::get('login', [LoginController::class, 'show']);
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('register', [RegisterController::class, 'show']);
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function(){
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('/tasks/{task}/start', [TaskController::class, 'start']);
    Route::get('/tasks/{task}/complete', [TaskController::class, 'complete']);
});

Route::middleware('is_admin')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/create', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::post('/users/{user}/edit', [UserController::class, 'update']);
    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks/create', [TaskController::class, 'store']);
});

