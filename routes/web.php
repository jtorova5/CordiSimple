<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/events', function(){
    return view('events');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::post('events', [EventController::class, 'store'])->name('events.store');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservations/indexUser', [ReservationController::class, 'indexUser'])->name('reservations.indexUser');
Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// Solo los usuarios regulares (User) pueden ver las reservas
Route::middleware(['auth'])->group(function () {
    // Rutas para usuarios regulares
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    });

    // Rutas para administradores
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
    });
});


require __DIR__ . '/auth.php';
