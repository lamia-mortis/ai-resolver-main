<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB;

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
            ['key' => 'r_cube', 'name' => 'Cube'], 
            ['key' => 'sudoku', 'name' => 'Sudoku'],
        ]);
    }
}
