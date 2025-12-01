<?php

use App\Http\Controllers\Manager\WorkerController;
use App\Http\Controllers\Worker\JobsController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
});

Route::group(['middleware' => ['auth', 'checkRole:manager']], function () {
    Route::resource('workers', WorkerController::class);
});


