<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\TradingController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/')->name('admin.')->middleware('auth', 'verified', 'admin')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/finance', FinanceController::class);
    Route::controller(HistoryController::class)->prefix('history')->name('history.')->group(function () {
        Route::view('users', 'admin.history.users')->name('users');
        Route::view('setting', 'admin.history.setting')->name('setting');
        Route::view('withdraws', 'admin.history.withdraw')->name('withdraw');
        Route::view('withdraws-approve', 'admin.history.withdrawApprove')->name('withdraw.approved');
        Route::view('deposits', 'admin.history.deposits')->name('deposits');
        Route::view('all', 'admin.history.all')->name('all');
    });
    Route::resource('/finance', FinanceController::class);
    Route::resource('/trading', TradingController::class);
    Route::resource('/plan', PlanController::class);
    // Route::view('/kyc', 'admin.kyc.index')->name('kyc.index');
});
