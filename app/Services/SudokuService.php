<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\APIs\MindMsApi;
use App\Services\DTOs\SudokuData;  
use App\Factories\SudokuFactory;

class SudokuService 
{
    public function __construct(
        private readonly MindMsApi $mindMsApi
    ) {}

    public function solve(SudokuData $sudoku): SudokuData
    {
       $solved = $this->mindMsApi->send('POST', '/sudoku/solve', $sudoku->toArray());
       return SudokuFactory::createDto($solved);
    }
}