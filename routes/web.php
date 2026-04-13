<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\SpecialistController as AdminSpecialistController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// лк
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/edit', [DashboardController::class, 'editProfile'])->name('dashboard.edit');
    Route::put('/dashboard', [DashboardController::class, 'updateProfile'])->name('dashboard.update');

    Route::get('/dashboard/favorites', [DashboardController::class, 'favorites'])->name('dashboard.favorites');
    Route::post('/favorites/{serviceId}', [DashboardController::class, 'addFavorite'])->name('favorites.add');
    Route::delete('/favorites/{serviceId}', [DashboardController::class, 'removeFavorite'])->name('favorites.remove');

    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancelReservation'])->name('reservations.cancel');
    Route::get('/dashboard/update-status', [DashboardController::class, 'updateReservationsStatus'])->name('dashboard.update-status');
});

// админка
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // пользователи
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // услуги
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index'])->name('index');
        Route::get('/create', [AdminServiceController::class, 'create'])->name('create');
        Route::post('/', [AdminServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [AdminServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [AdminServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->name('destroy');
    });

    // категории
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // специалисты
    Route::prefix('specialists')->name('specialists.')->group(function () {
        Route::get('/', [AdminSpecialistController::class, 'index'])->name('index');
        Route::get('/create', [AdminSpecialistController::class, 'create'])->name('create');
        Route::post('/', [AdminSpecialistController::class, 'store'])->name('store');
        Route::get('/{specialist}/edit', [AdminSpecialistController::class, 'edit'])->name('edit');
        Route::put('/{specialist}', [AdminSpecialistController::class, 'update'])->name('update');
        Route::delete('/{specialist}', [AdminSpecialistController::class, 'destroy'])->name('destroy');
    });
});

Route::fallback([HomeController::class, 'index']);