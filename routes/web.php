<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Rutas públicas para el login
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
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

// Rutas para usuarios regulares (User)
Route::middleware(['auth:web'])->group(function () {
    // Reservas
    Route::get('reservations/create', [ReservationUserController::class, 'create'])->name('reservations.create');
    Route::get('reservations/indexUser', [ReservationUserController::class, 'indexUser'])->name('reservations.indexUser');
    // Route::get('/reservations/{reservation}', [ReservationUserController::class, 'showUser'])->name('reservations.showUser');
    Route::get('reservations/{id}/edit', [ReservationUserController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{id}', [ReservationUserController::class, 'update'])->name('reservations.update');
    Route::delete('reservations/{id}', [ReservationUserController::class, 'destroy'])->name('reservations.destroy');
    
    // Eventos
    Route::get('events/user', [PublicEventController::class, 'index'])->name('public.events.index');
    Route::get('/events/public/{id}', [PublicEventController::class, 'show'])->name('events.show');
    Route::post('/user/events/{id}/purchase', [PublicEventController::class, 'purchase'])->name('events.purchase');
});

// Rutas para administradores (Admin)
Route::middleware(['auth:admin'])->group(function () {
    // Reservas
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    
    // Eventos
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

require __DIR__ . '/auth.php';
