<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; 
use App\Services\Enums\Puzzles; 

class PuzzleGeneralSeeder extends Seeder
{
    public function run()
    {
        DB::table('puzzles_general')->insert([
            ['key' => Puzzles::rubikCube(), 'name' => 'Rubik\'s Cube'], 
            ['key' => Puzzles::sudoku(),    'name' => 'Sudoku'],
        ]);
    }
}
