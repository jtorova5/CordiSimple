<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas públicas para el login
Route::get('login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'login']); // Procesa el login

// Ruta para logout
Route::post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación (dashboard y perfil)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('reservations/reservation', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

require __DIR__ . '/auth.php';
