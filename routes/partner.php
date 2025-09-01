<?php

use App\Http\Controllers\Partner\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:partner'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('partner.dashboard');
    });
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Warehouses routes
        Route::controller(LandlordWarehouseController::class)->prefix('warehouses')->name('warehouses.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{warehouse}/edit', 'edit')->name('edit');
            Route::post('{warehouse}', 'update')->name('update');
            Route::delete('{warehouse}', 'destroy')->name('destroy');
        });
    // Warehouses routes

    // Bookings routes
        Route::controller(LandlordBookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('{booking}/edit', 'edit')->name('edit');
            Route::post('{booking}', 'update')->name('update');
            Route::delete('{booking}', 'destroy')->name('destroy');
        });
    // Bookings routes

    // Favorite routes
        Route::controller(FavoriteController::class)->prefix('favorites')->name('favorites.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{favorite}', 'destroy')->name('destroy');
        });
    // Favorite routes

    // Settings routes
        Route::controller(LandlordSettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('{user}/profile', 'profile')->name('profile');
            Route::post('{user}/password', 'password')->name('password');
            Route::post('{user}/company/{company}', 'company')->name('company');
        });
    // Settings routes

    // Messages routes
        Route::controller(LandlordMessageController::class)->prefix('messages')->name('messages.')->group(function() {
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