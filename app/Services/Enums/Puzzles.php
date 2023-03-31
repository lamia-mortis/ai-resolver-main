<?php

declare(strict_types=1);

namespace App\Services\Enums; 

enum Puzzles: string 
{
    case RUBIK_CUBE = 'rubik-cube'; 
    case SUDOKU = 'sudoku'; 
    case ALL = 'puzzles_general';

    public static function rubikCube(): string
    {
        return self::RUBIK_CUBE->value;
    }

    public static function sudoku(): string 
    {
        return self::SUDOKU->value;
    }

    public static function all(): string 
    {
        return self::ALL->value;
    }
}