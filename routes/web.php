<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::resource('workers', WorkerController::class);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
