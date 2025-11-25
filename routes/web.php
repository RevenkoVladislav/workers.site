<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::name('workers.')->group(function () {
    Route::resource('workers', WorkerController::class);
});
