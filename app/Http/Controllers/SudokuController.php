<?php

declare(strict_types=1);

namespace App\Http\Controllers;
 
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log; 
use App\Services\Enums\Puzzles; 
use App\Http\Requests\SudokuRequest;
use App\Services\SudokuService;
use stdClass;
use Throwable;

class SudokuController extends Controller
{
    public function __construct(
        protected SudokuService $sudokuService
    ) {}

    /**
     * default properties of the props:array see in HandleInertiaRequest share() method
     * @return \Inertia\Response{component:string,props:array<sudokuSolveUrl:string>}
     */
    public function index(): InertiaResponse
    {
        [$componentPath, $componentName] = get_component_path(Puzzles::sudoku(), __FUNCTION__);
        return Inertia::render("$componentPath/$componentName", [
            'sudokuSolveUrl' => route(Puzzles::sudoku() . ".solve"),
        ]);
    }

    /**
     * @param array<board:array<array<int>>,squareSize:int> $request
     * @return array<success:bool,sudoku:SudokuData|stdClass>
     */
    public function solve(SudokuRequest $request): JsonResponse
    {
        try {
            $solved = $this->sudokuService->solve($request->getFilledDto());
            return response()->json(['success' => true,  Puzzles::sudoku() => $solved]);
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return response()->json(['success' => false, Puzzles::sudoku() => new stdClass()], 500);
        }
    }
}
