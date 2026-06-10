<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('main');
});

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');