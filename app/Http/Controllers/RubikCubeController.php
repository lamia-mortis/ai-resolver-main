<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Contracts\View\View;
use App\Services\PuzzlesGeneralService; 
use App\Services\Puzzles; 

class RubikCubeController extends Controller
{
    private const PUZZLE_KEY = Puzzles::RUBIK_CUBE->value;

    public function index(PuzzlesGeneralService $puzzlesGeneralService): View
    {
        $pageInfo = ['currentPuzzle' => self::PUZZLE_KEY , 'type' => __FUNCTION__];
        $viewPath = $pageInfo['currentPuzzle'] . '/' . $pageInfo['type'];

        return view($viewPath, [
            'puzzles' => $puzzlesGeneralService->getGeneralPuzzlesInfo(),
            'pageInfo' => $pageInfo,
        ]);
    }
}
