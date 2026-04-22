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

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.dashboard');

Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.users');

Route::get('/admin/deceaseds', [App\Http\Controllers\AdminController::class, 'deceaseds'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds');

Route::get('/admin/deceaseds/create', [App\Http\Controllers\AdminController::class, 'createDeceased'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds.create');

Route::post('/admin/deceaseds', [App\Http\Controllers\AdminController::class, 'storeDeceased'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds.store');

Route::get('/admin/deceaseds/{id}/edit', [App\Http\Controllers\AdminController::class, 'editDeceased'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds.edit');

Route::put('/admin/deceaseds/{id}', [App\Http\Controllers\AdminController::class, 'updateDeceased'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds.update');

Route::delete('/admin/deceaseds/{id}', [App\Http\Controllers\AdminController::class, 'deleteDeceased'])
    ->middleware(['auth', App\Http\Middleware\AdminMiddleware::class])
    ->name('admin.deceaseds.destroy');
