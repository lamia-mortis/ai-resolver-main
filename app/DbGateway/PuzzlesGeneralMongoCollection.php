<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class PuzzlesGeneralMongoCollection
{
    private const MONGO_COLLECTION_NAME = 'puzzles_general';

    public function getPuzzles(): array
    {
        try {
            $data = DB::table(self::MONGO_COLLECTION_NAME)
                       ->select('*')
                       ->get()
                       ->toArray();

            return filter_mongo_id($data);
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}