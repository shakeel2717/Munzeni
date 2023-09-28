<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login');
Route::prefix('user/')->name('user.')->middleware('auth', 'verified')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/withdraw', WithdrawController::class);
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
