<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/transfer', [TransferController::class, 'index'])->name('transfer.index');
    Route::post('/transfer', [TransferController::class, 'create'])->name('transfer.create');

    Route::get('/withdraw', [WithDrawController::class, 'index'])->name('withdraw.index');
    Route::post('/withdraw', [WithDrawController::class, 'create'])->name('withdraw.create');

    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
    Route::post('/deposit', [DepositController::class, 'create'])->name('deposit.create');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/pin-check', [BankAccountController::class, 'pinCheck'])->name('security.pin');
    Route::post('/account-check', [BankAccountController::class, 'accountCheck'])->name('account.check');

});

require __DIR__.'/auth.php';
