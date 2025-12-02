<?php

use App\Http\Controllers\Manager\WorkerController;
use App\Http\Controllers\Worker\JobsController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Auth::routes(['verify' => true]);
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [JobsController::class, 'index'])->name('jobs.index');
});

Route::group(['middleware' => ['auth', 'verified', 'checkRole:Manager']], function () {
    Route::resource('workers', WorkerController::class);
});


