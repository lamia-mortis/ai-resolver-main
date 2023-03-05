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
     * @return \App\Services\DTOs\PuzzleData{url:string}[];
     */
    public function getGeneralPuzzlesInfo(): array
    {
        return array_map(
            static fn($puzzle) => $puzzle->getWithUrl(), 
            $this->puzzlesGeneralMongoCollection->getPuzzles()
        );
    }
}