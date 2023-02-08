<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Contracts\View\View;
use App\Services\PuzzlesGeneralService;
use Illuminate\Http\JsonResponse; 
use App\Services\Puzzles; 

class SudokuController extends Controller
{
    private const PUZZLE_KEY = Puzzles::SUDOKU->value;

    public function index(PuzzlesGeneralService $puzzlesGeneralService): View
    {
        $pageInfo = ['currentPuzzle' => self::PUZZLE_KEY , 'type' => __FUNCTION__];
        $viewPath = $pageInfo['currentPuzzle'] . '/' . $pageInfo['type'];

        return view($viewPath, [
            'puzzles' => $puzzlesGeneralService->getGeneralPuzzlesInfo(),
            'pageInfo' => $pageInfo,
        ]);
    }

    public function solve(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 201]);
    }
}
