<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; 
use App\Services\Puzzles; 

class PuzzleGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('puzzles_general')->insert([
            ['key' => Puzzles::RUBIK_CUBE->value, 'name' => 'Rubik\'s Cube'], 
            ['key' => Puzzles::SUDOKU->value, 'name' => 'Sudoku'],
        ]);
    }
}
