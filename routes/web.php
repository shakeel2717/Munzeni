<?php

use App\Http\Controllers\KycController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\HistoryController;
use App\Http\Controllers\user\ReferralController;
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
    Route::resource('/referral', ReferralController::class);
    Route::resource('/password', PasswordController::class);
    Route::resource('/trading', TradeController::class);
    Route::controller(HistoryController::class)->name('history.')->prefix('history/')->group(function () {
        Route::view('deposit', 'user.history.deposit')->name('deposits');
        Route::view('withdrawals', 'user.history.withdrawals')->name('withdrawals');
        Route::view('trades', 'user.history.trades')->name('trades');
        Route::view('direct_commission', 'user.history.direct_commission')->name('direct_commissions');
        Route::view('indirect_commission', 'user.history.indirect_commission')->name('indirect_commissions');
        Route::view('direct_referrals', 'user.history.direct_referrals')->name('direct_referrals');
        Route::view('indirect_referrals', 'user.history.indirect_referrals')->name('indirect_referrals');
    });
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
