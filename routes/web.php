<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Главная страница
Route::get('/', function () {
    return view('main');
})->name('home');

// Отправка формы контактов (только один раз!)
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Аутентификация
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

// Админ-панель
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/requests/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/requests/{id}', [AdminController::class, 'showRequest'])->name('admin.request');
    Route::delete('/requests/{id}', [AdminController::class, 'deleteRequest'])->name('admin.deleteRequest');
});

Route::get('/check-auth', function() {
    return response()->json(['authenticated' => Auth::check()]);
})->name('check.auth');