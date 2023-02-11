<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; 

class FlexibleConfigSeeder extends Seeder
{
    public function run()
    {
        $flexConfigSections = array_map(
            static fn($settings) => json_encode($settings), 
            config('flexible_config', [])
        );

        DB::table('flexible_config')->insert($flexConfigSections);
    }
}
