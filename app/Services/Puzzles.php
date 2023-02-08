<?php

declare(strict_types=1);

namespace App\Services; 

enum Puzzles: string 
{
    case RUBIK_CUBE = 'rubik-cube'; 
    case SUDOKU = 'sudoku';
}