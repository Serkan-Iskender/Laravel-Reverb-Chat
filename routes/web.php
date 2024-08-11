<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ChatController::class, 'index'])->name('index');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');


Route::get('/login', [UserController::class, 'loginPage'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login-post');
Route::post('/register', [UserController::class, 'register'])->name('register');
