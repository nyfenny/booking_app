<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\IsAdmin;

// Halaman welcome (public)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about.index');
})->name('about');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (hanya setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Semua route setelah login
Route::middleware('auth')->group(function () {
    // Semua user (admin / user biasa) bisa lihat bookings
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');

    // Khusus admin
    Route::middleware(IsAdmin::class)->group(function () {
        
        Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    // Route detail booking taruh paling bawah biar nggak nutupin "create" & "edit"
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    // Admin juga kelola user & room
    Route::middleware(IsAdmin::class)->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('rooms', RoomController::class);
    });
});

