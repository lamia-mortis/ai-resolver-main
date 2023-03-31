<?php

declare(strict_types=1);

use App\Http\Controllers\AppStateController;
use App\Services\Enums\FlexibleConfigs;
use App\Http\Controllers\RubikCubeController; 
use App\Http\Controllers\SudokuController; 
use Illuminate\Support\Facades\Route; 
use App\Services\Enums\Puzzles;
use App\Http\Controllers\FlexibleConfigController;

// routes names
$rubikCube       = Puzzles::rubikCube(); 
$sudoku          = Puzzles::sudoku(); 
$flexibleConfig  = FlexibleConfigs::all();

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
    Route::put('/update', [FlexibleConfigController::class, 'update'])->name("$flexibleConfig.update");
});

Route::prefix('/app-state')->group(static function() {
    Route::post('/save-logs', [AppStateController::class, 'saveLogs'])->name('app-state.save-logs');
});