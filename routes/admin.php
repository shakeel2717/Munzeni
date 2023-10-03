<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\HistoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/')->name('admin.')->middleware('auth', 'verified', 'admin')->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/finance', FinanceController::class);
    Route::controller(HistoryController::class)->prefix('history')->name('history.')->group(function () {
        Route::view('users', 'admin.history.users')->name('users');
        Route::view('setting', 'admin.history.setting')->name('setting');
    });
    Route::resource('/finance', FinanceController::class);
    Route::view('/kyc', 'admin.kyc.index')->name('kyc.index');
});
