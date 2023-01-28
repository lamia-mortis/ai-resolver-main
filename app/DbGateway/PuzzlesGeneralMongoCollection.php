<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB;

class PuzzlesGeneralMongoCollection
{
    private const MONGO_COLLECTION_NAME = 'puzzles_general';

    public function getPuzzles(): array
    {
        return DB::table(self::MONGO_COLLECTION_NAME)
                    ->select('*')
                    ->get()
                    ->toArray();
    }
}