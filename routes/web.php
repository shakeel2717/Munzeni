<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\user\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);

Route::prefix('user/')->name('user.')->middleware('auth','verified')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
});


require __DIR__ . '/auth.php';
