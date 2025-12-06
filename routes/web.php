<?php

use App\Http\Controllers\Manager\CompanyController;
use App\Http\Controllers\Manager\WorkerController;
use App\Http\Controllers\Worker\WorkingController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Auth::routes(['verify' => true]);
});


Route::prefix('workings')->name('workers.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('/', [WorkingController::class, 'index'])->name('working.index');
        Route::get('/{working}/show', [WorkingController::class, 'show'])->name('working.show');
    });
});

Route::group(['middleware' => ['auth', 'verified', 'checkRole:Manager']], function () {
    Route::resource('workers', WorkerController::class);
    Route::resource('companies', CompanyController::class)->except(['show']);
});


