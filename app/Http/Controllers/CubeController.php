<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Contracts\View\View;
use App\Services\PuzzlesGeneralService;

class CubeController extends Controller
{
    public function index(PuzzlesGeneralService $puzzlesGeneralService): View
    {
        return view('cube.index', [
            'puzzles' => $puzzlesGeneralService->getGeneralPuzzlesInfo()
        ]);
    }
}
