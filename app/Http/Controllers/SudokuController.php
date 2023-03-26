<?php

declare(strict_types=1);

namespace App\Http\Controllers;
 
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\JsonResponse; 
use App\Services\Enums\Puzzles; 
use App\Http\Requests\SudokuRequest;

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

    /**
     * @param array<board:array<array<int>>,squareSize:int>
     */
    public function solve(SudokuRequest $request): JsonResponse
    {
        $request->getFilledDto();
        return response()->json(['success' => true, 201]);
    }
}
