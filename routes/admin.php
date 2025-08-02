<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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
            Route::get('order-by', 'orderBY')->name('order-by');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{user}/edit', 'edit')->name('edit');
            Route::post('{user}', 'update')->name('update');
            Route::delete('{user}', 'destroy')->name('destroy');
        });
    // Users routes

    // Froala upload route
        Route::controller(FroalaController::class)->prefix('froala')->name('froala.')->group(function() {
            Route::post('upload', 'upload')->name('upload');
            Route::post('delete', 'delete')->name('delete');
        });
    // Froala upload route



    // Warehouses routes
        Route::controller(AdminWarehouseController::class)->prefix('warehouses')->name('warehouses.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{warehouse}/edit', 'edit')->name('edit');
            Route::post('{warehouse}', 'update')->name('update');
            Route::delete('{warehouse}', 'destroy')->name('destroy');
        });
    // Warehouses routes

    // Storage types routes
        Route::controller(StorageTypeController::class)->prefix('storage-types')->name('storage-types.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{storage_type}/edit', 'edit')->name('edit');
            Route::post('{storage_type}', 'update')->name('update');
            Route::delete('{storage_type}', 'destroy')->name('destroy');
        });
    // Storage types routes

    // Bookings routes
        Route::controller(BookingController::class)->prefix('bookings')->name('bookings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{booking}/edit', 'edit')->name('edit');
            Route::post('{booking}', 'update')->name('update');
            Route::delete('{booking}', 'destroy')->name('destroy');
        });
    // Bookings routes

    // Todos routes
        Route::controller(TodoController::class)->prefix('todos')->name('todos.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::post('{todo}/favorite', 'favorite')->name('favorite');
            Route::post('{todo}/complete', 'complete')->name('complete');
            Route::post('{todo}/destroy', 'destroy')->name('destroy');
        });
    // Todos routes

    // Settings routes
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('{user}/profile', 'profile')->name('profile');
            Route::post('{user}/password', 'password')->name('password');
            Route::post('{setting}/website', 'website')->name('website');
        });
    // Settings routes

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

    // Article categories routes
        Route::controller(ArticleCategoryController::class)->prefix('article-categories')->name('article-categories.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{article_category}/edit', 'edit')->name('edit');
            Route::post('{article_category}', 'update')->name('update');
            Route::delete('{article_category}', 'destroy')->name('destroy');
        });
    // Article categories routes

    // Articles routes
        Route::controller(ArticleArticleController::class)->prefix('articles')->name('articles.')->group(function() {
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

    // Supports routes
        Route::controller(SubscriptionController::class)->prefix('subscriptions')->name('subscriptions.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{subscription}', 'destroy')->name('destroy');
        });
    // Supports routes

    // Supports routes
        Route::controller(AdminSupportController::class)->prefix('supports')->name('supports.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::delete('{support}', 'destroy')->name('destroy');
        });
    // Supports routes

    // Reports routes
        Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('filter', 'filter')->name('filter');
            Route::get('{report}/edit', 'edit')->name('edit');
            Route::post('{report}', 'update')->name('update');
            Route::delete('{report}', 'destroy')->name('destroy');
        });
    // Reports routes
});