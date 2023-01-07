<?php

declare(strict_types=1);

use App\Http\Controllers\CubeController; 
use App\Http\Controllers\SudokuController; 
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect(route('cube.index'));
});

Route::prefix('/cube')->group(static function() {
    Route::get('/', [CubeController::class, 'index'])->name('cube.index');
});

Route::prefix('/sudoku')->group(static function() {
    Route::get('/', [SudokuController::class, 'index'])->name('sudoku.index');
});