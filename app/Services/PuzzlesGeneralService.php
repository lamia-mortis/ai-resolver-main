<?php

declare(strict_types=1);

namespace App\Services; 

use App\DbGateway\PuzzlesGeneralTable;

class PuzzlesGeneralService 
{
    public function __construct(
        protected PuzzlesGeneralTable $puzzlesGeneralTable
    ){}

    /**
     * @return array<\App\Services\DTOs\PuzzleData>;
     */
    public function getGeneralPuzzlesInfo(): array
    {
        return $this->puzzlesGeneralTable->getPuzzles();
    }
}