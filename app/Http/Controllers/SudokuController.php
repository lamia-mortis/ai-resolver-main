<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Inertia\Response as InertiaResponse;
use App\Services\PuzzlesGeneralService;
use Illuminate\Http\JsonResponse; 
use App\Services\Enums\Puzzles; 
use Inertia\Inertia;

class SudokuController extends Controller
{
    private const PUZZLE_KEY = Puzzles::SUDOKU->value;

    /**
     * default properties of the props:array see in HandleInertiaRequest share() method
     * @return \Inertia\Response{component:string,props:array}
     */
    public function index(): InertiaResponse
    {
        [$componentPath, $componentName] = get_component_path(self::PUZZLE_KEY, __FUNCTION__);
        return Inertia::render("$componentPath/$componentName");
    }

    public function solve(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 201]);
    }
}
