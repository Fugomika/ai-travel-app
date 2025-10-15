<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PreferenceController;

Route::get('/', function () { return view('welcome'); });

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register: show form + handle submit
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Preferensi Liburan: pertanyaan awal
Route::get('/preferensi', [PreferenceController::class, 'show'])->name('preferensi');
Route::post('/preferensi', [PreferenceController::class, 'store'])->name('preferensi.store');
