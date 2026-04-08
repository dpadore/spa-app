<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

Auth::routes();

// Публичные страницы (доступны всем)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Защищенные маршруты 
Route::middleware(['auth.notice'])->group(function () {
    
    // Лк
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/edit', [DashboardController::class, 'editProfile'])->name('dashboard.edit');
    Route::put('/dashboard', [DashboardController::class, 'updateProfile'])->name('dashboard.update');

    // Избранное
    Route::get('/dashboard/favorites', [DashboardController::class, 'favorites'])->name('dashboard.favorites');
    Route::post('/favorites/{serviceId}', [DashboardController::class, 'addFavorite'])->name('favorites.add');
    Route::delete('/favorites/{serviceId}', [DashboardController::class, 'removeFavorite'])->name('favorites.remove');

    // Бронирование
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancelReservation'])->name('reservations.cancel');
});

Route::fallback([HomeController::class, 'index']);