<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Inertia\Response as InertiaResponse;
use App\Services\PuzzlesGeneralService;
use Illuminate\Http\JsonResponse; 
use App\Services\Puzzles; 
use Inertia\Inertia;

class SudokuController extends Controller
{
    private const PUZZLE_KEY = Puzzles::SUDOKU->value;

    public function index(PuzzlesGeneralService $puzzlesGeneralService): InertiaResponse
    {
        $componentPath = implode(array_map('ucfirst', explode('-', self::PUZZLE_KEY))); 
        $componentName = $componentPath . ucfirst(__FUNCTION__);
        
        return Inertia::render("$componentPath/$componentName");
    }

    public function solve(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 201]);
    }
}
