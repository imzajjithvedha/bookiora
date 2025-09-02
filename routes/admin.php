<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FroalaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Stay\StayBookingController;
use App\Http\Controllers\Admin\Stay\StayController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\SurfCamp\SurfCampBookingController;
use App\Http\Controllers\Admin\SurfCamp\SurfCampController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleRental\VehicleRentalBookingController;
use App\Http\Controllers\Admin\VehicleRental\VehicleRentalController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users routes
        Route::controller(UserController::class)->prefix('users')->name('users.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{user}/edit', 'edit')->name('edit');
            Route::post('{user}', 'update')->name('update');
            Route::delete('{user}', 'destroy')->name('destroy');
        });
    // Users routes

    // Messages routes
        Route::controller(MessageController::class)->prefix('messages')->name('messages.')->group(function() {
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

    // Subscriptions routes
        Route::controller(SubscriptionController::class)->prefix('subscriptions')->name('subscriptions.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{subscription}', 'destroy')->name('destroy');
        });
    // Subscriptions routes

    // Supports routes
        Route::controller(SupportController::class)->prefix('supports')->name('supports.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{support}', 'destroy')->name('destroy');
        });
    // Supports routes

    // Stays routes
        Route::controller(StayController::class)->prefix('stays')->name('stays.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{stay}/edit', 'edit')->name('edit');
            Route::post('{stay}', 'update')->name('update');
            Route::delete('{stay}', 'destroy')->name('destroy');

            Route::controller(StayBookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('filter', 'filter')->name('filter');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{booking}/edit', 'edit')->name('edit');
                Route::post('{booking}', 'update')->name('update');
                Route::delete('{booking}', 'destroy')->name('destroy');
            });
        });
    // Stays routes

    // Surf camps routes
        Route::controller(SurfCampController::class)->prefix('surf-camps')->name('surf-camps.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{surf_camp}/edit', 'edit')->name('edit');
            Route::post('{surf_camp}', 'update')->name('update');
            Route::delete('{surf_camp}', 'destroy')->name('destroy');

            Route::controller(SurfCampBookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('filter', 'filter')->name('filter');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{booking}/edit', 'edit')->name('edit');
                Route::post('{booking}', 'update')->name('update');
                Route::delete('{booking}', 'destroy')->name('destroy');
            });
        });
    // Surf camps routes

    // Vehicle rentals routes
        Route::controller(VehicleRentalController::class)->prefix('vehicle-rentals')->name('vehicle-rentals.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{vehicle_rental}/edit', 'edit')->name('edit');
            Route::post('{vehicle_rental}', 'update')->name('update');
            Route::delete('{vehicle_rental}', 'destroy')->name('destroy');

            Route::controller(VehicleRentalBookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('filter', 'filter')->name('filter');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{booking}/edit', 'edit')->name('edit');
                Route::post('{booking}', 'update')->name('update');
                Route::delete('{booking}', 'destroy')->name('destroy');
            });
        });
    // Vehicle rentals routes

    // Reports routes
        Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('{report}/edit', 'edit')->name('edit');
            Route::post('{report}', 'update')->name('update');
            Route::delete('{report}', 'destroy')->name('destroy');
        });
    // Reports routes

    // Froala upload route
        Route::controller(FroalaController::class)->prefix('froala')->name('froala.')->group(function() {
            Route::post('upload', 'upload')->name('upload');
            Route::post('delete', 'delete')->name('delete');
        });
    // Froala upload route

    // Settings routes
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('{user}/profile', 'profile')->name('profile');
            Route::post('{user}/password', 'password')->name('password');
            Route::post('{setting}/website', 'website')->name('website');
        });
    // Settings routes

    // Articles routes
        Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{article}/edit', 'edit')->name('edit');
            Route::post('{article}', 'update')->name('update');
            Route::delete('{article}', 'destroy')->name('destroy');
        });
    // Articles routes

    // Reviews routes
        Route::controller(ReviewController::class)->prefix('reviews')->name('reviews.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{review}/edit', 'edit')->name('edit');
            Route::post('{review}', 'update')->name('update');
            Route::delete('{review}', 'destroy')->name('destroy');
        });
    // Reviews routes
});