<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WorkerController::class, 'index'])->name('workers.index');
