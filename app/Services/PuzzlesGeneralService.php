<?php

declare(strict_types=1);

namespace App\Services; 

use App\DbGateway\PuzzlesGeneralMongoCollection;

class PuzzlesGeneralService 
{
    public function __construct(
        protected PuzzlesGeneralMongoCollection $puzzlesGeneralMongoCollection
    ){}

    /**
     * @return array<\App\Services\DTOs\PuzzleData>;
     */
    public function getGeneralPuzzlesInfo(): array
    {
        return $this->puzzlesGeneralMongoCollection->getPuzzles();
    }
}