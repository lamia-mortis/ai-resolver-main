<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Enums\Puzzles; 
use Throwable;

class PuzzlesGeneralTable
{
    /**
     * @return array<\App\Services\DTOs\PuzzleData>;
     */
    public function getPuzzles(): array
    {
        try {
            return DB::table(Puzzles::all())
                       ->select(['key', 'name'])
                       ->get()
                       ->fillWithDto(Puzzles::all())
                       ->toArray();
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }
}