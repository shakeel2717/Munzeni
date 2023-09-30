<?php

use App\Http\Controllers\KycController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login');
Route::prefix('user/')->name('user.')->middleware('auth', 'verified')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/withdraw', WithdrawController::class);
    Route::resource('/wallet', WalletController::class);
    Route::resource('/plan', PlanController::class);
    Route::resource('/kyc', KycController::class);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/password', PasswordController::class);
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
