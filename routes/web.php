<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;



Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


// Главная страница
Route::get('/', function () {
    return view('main');
})->name('home');

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

// Отправка формы контактов
Route::post('/contact/send', function () {
    // Здесь логика отправки
    return response()->json(['success' => true]);
})->name('contact.send');

Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Админ-панель
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::post('/requests/{id}/status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/requests/{id}', [App\Http\Controllers\AdminController::class, 'showRequest'])->name('admin.request');
    Route::delete('/requests/{id}', [App\Http\Controllers\AdminController::class, 'deleteRequest'])->name('admin.deleteRequest');
});