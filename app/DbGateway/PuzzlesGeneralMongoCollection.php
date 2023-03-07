<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Enums\Puzzles; 
use Throwable;

class PuzzlesGeneralMongoCollection
{
    private const MONGO_COLLECTION_NAME = Puzzles::ALL->value;

    /**
     * @return \App\Services\DTOs\PuzzleData[];
     */
    public function getPuzzles(): array
    {
        try {
            return DB::table(self::MONGO_COLLECTION_NAME)
                       ->select(['key', 'name'])
                       ->get()
                       ->fillWithDto(self::MONGO_COLLECTION_NAME)
                       ->toArray();
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }
}