<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Contracts\View\View;
use App\Services\PuzzlesGeneralService;

class RubikCubeController extends Controller
{
    private const PUZZLE_KEY = 'rubik-cube';

    public function index(PuzzlesGeneralService $puzzlesGeneralService): View
    {
        return view('rubik-cube.index', [
            'puzzles' => $puzzlesGeneralService->getGeneralPuzzlesInfo(),
            'pageInfo' => ['currentPuzzle' => self::PUZZLE_KEY , 'type' => __FUNCTION__],
        ]);
    }
}
