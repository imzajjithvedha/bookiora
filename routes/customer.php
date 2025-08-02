<?php

use App\Http\Controllers\Customer\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('dashboard', function () {
        return redirect()->route('customer.dashboard');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Bookings routes
        Route::controller(TenantBookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('{booking}/edit', 'edit')->name('edit');
            Route::post('{booking}', 'update')->name('update');
            Route::delete('{booking}', 'destroy')->name('destroy');
        });
    // Bookings routes

    // Favorite routes
        Route::controller(TenantFavoriteController::class)->prefix('favorites')->name('favorites.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{favorite}', 'destroy')->name('destroy');
        });
    // Favorite routes

    // Todos routes
        Route::controller(TenantTodoController::class)->prefix('todos')->name('todos.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::post('{todo}/favorite', 'favorite')->name('favorite');
            Route::post('{todo}/complete', 'complete')->name('complete');
            Route::post('{todo}/destroy', 'destroy')->name('destroy');
        });
    // Todos routes

    // Settings routes
        Route::controller(TenantSettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('{user}/profile', 'profile')->name('profile');
            Route::post('{user}/password', 'password')->name('password');
            Route::post('{user}/company/{company}', 'company')->name('company');
        });
    // Settings routes

    // Messages routes
        Route::controller(TenantMessageController::class)->prefix('messages')->name('messages.')->group(function() {
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{category}', 'index')->name('index');
            Route::get('{category}/filter', 'filter')->name('filter');
            Route::get('{message}/edit', 'edit')->name('edit');
            Route::post('{message}/update', 'update')->name('update');

            Route::post('{message}/favorite', 'favorite')->name('favorite');
            Route::post('favorite/bulk', 'bulkFavorite')->name('bulk-favorite');
            Route::post('destroy/bulk', 'bulkDestroy')->name('bulk-destroy');
            Route::post('recover/bulk', 'bulkRecover')->name('bulk-recover');
        });
    // Messages routes
});