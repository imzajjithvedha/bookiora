<?php

use App\Http\Controllers\Admin\Article\ArticleController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PrivacyPolicyController;
use App\Http\Controllers\Website\TermsAndConditionController;
use App\Http\Controllers\Website\WarehouseController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::prefix('articles')->name('articles.')->group(function() {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('show/{article}', [ArticleController::class, 'show'])->name('show');
});
Route::prefix('contact-us')->name('contact-us.')->group(function() {
    Route::get('/', [SupportController::class, 'index'])->name('index');
    Route::post('/', [SupportController::class, 'store'])->name('store');
});
Route::prefix('stays')->name('stays.')->group(function () {
    Route::get('/', [WarehouseController::class, 'index'])->name('index');
    Route::post('/', [WarehouseController::class, 'store'])->name('store');
    Route::get('filter', [WarehouseController::class, 'filter'])->name('filter');
    Route::get('show/{stay}', [WarehouseController::class, 'show'])->name('show');
    Route::post('expert', [WarehouseController::class, 'expert'])->name('expert');
    Route::post('report', [WarehouseController::class, 'report'])->name('report');
    Route::post('favorite', [WarehouseController::class, 'favorite'])->name('favorite');
});
Route::prefix('surf-camps')->name('surf-camps.')->group(function () {
    Route::get('/', [WarehouseController::class, 'index'])->name('index');
    Route::post('/', [WarehouseController::class, 'store'])->name('store');
    Route::get('filter', [WarehouseController::class, 'filter'])->name('filter');
    Route::get('show/{surf_camp}', [WarehouseController::class, 'show'])->name('show');
    Route::post('expert', [WarehouseController::class, 'expert'])->name('expert');
    Route::post('report', [WarehouseController::class, 'report'])->name('report');
    Route::post('favorite', [WarehouseController::class, 'favorite'])->name('favorite');
});
Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('terms-and-conditions', [TermsAndConditionController::class, 'index'])->name('terms-of-use');
Route::post('subscriptions', [HomeController::class, 'subscriptions'])->name('subscriptions');
Route::prefix('careers')->name('careers.')->group(function() {
    Route::get('/', [CareerController::class, 'index'])->name('index');
    Route::get('show/{career}', [CareerController::class, 'show'])->name('show');
});