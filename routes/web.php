<?php

declare(strict_types=1);

use App\Services\Enums\FlexibleConfigs;
use App\Http\Controllers\RubikCubeController; 
use App\Http\Controllers\SudokuController; 
use Illuminate\Support\Facades\Route; 
use App\Services\Enums\Puzzles;
use App\Http\Controllers\FlexibleConfigController;

// routes names
$rubikCube = Puzzles::RUBIK_CUBE->value; 
$sudoku = Puzzles::SUDOKU->value; 
$flexibleConfig = FlexibleConfigs::ALL->value;

Route::get('/', static function () use($rubikCube) {
    return redirect(route("$rubikCube.index"));
});

Route::prefix("/$rubikCube")->group(static function() use($rubikCube) {
    Route::get('/', [RubikCubeController::class, 'index'])->name("$rubikCube.index");
});

Route::prefix("/$sudoku")->group(static function() use($sudoku) {
    Route::get('/', [SudokuController::class, 'index'])->name("$sudoku.index"); 
    Route::post('/solve', [SudokuController::class, 'solve'])->name("$sudoku.solve");
});

Route::prefix("/$flexibleConfig")->group(static function() use($flexibleConfig) {
    Route::get('/',[FlexibleConfigController::class, 'index'])->name("$flexibleConfig.index"); 
    Route::post('/store', [FlexibleConfigController::class, 'store'])->name("$flexibleConfig.store");
});