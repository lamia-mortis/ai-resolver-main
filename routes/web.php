<?php

declare(strict_types=1);

use App\Http\Controllers\RubikCubeController; 
use App\Http\Controllers\SudokuController; 
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect(route('rubik-cube.index'));
});

Route::prefix('/rubik-cube')->group(static function() {
    Route::get('/', [RubikCubeController::class, 'index'])->name('rubik-cube.index');
});

Route::prefix('/sudoku')->group(static function() {
    Route::get('/', [SudokuController::class, 'index'])->name('sudoku.index'); 
    Route::post('/solve', [SudokuController::class, 'solve'])->name('sudoku.solve');
});