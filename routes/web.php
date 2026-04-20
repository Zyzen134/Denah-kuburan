<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::redirect('/', '/Dashboard');

Route::get('/Dashboard', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
