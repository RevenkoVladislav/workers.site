<?php

use App\Http\Controllers\Manager\WorkerController;
use App\Http\Controllers\Worker\WorkingController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Auth::routes(['verify' => true]);
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [WorkingController::class, 'index'])->name('jobs.index');
});

Route::group(['middleware' => ['auth', 'verified', 'checkRole:Manager']], function () {
    Route::resource('workers', WorkerController::class);
});


