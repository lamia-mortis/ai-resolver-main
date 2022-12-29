<?php

use App\Http\Controllers\CubeController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect(route('cube.index'));
});

Route::prefix('/cube')->group(static function() {
    Route::get('/', [CubeController::class, 'index'])->name('cube.index');
});