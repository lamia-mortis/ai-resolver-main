<?php

declare(strict_types=1);

namespace App\Services; 

use App\DbGateway\PuzzlesGeneralMongoCollection;

class PuzzlesGeneralService 
{
    public function __construct(
        protected PuzzlesGeneralMongoCollection $puzzlesGeneralMongoCollection
    ){}

    public function getGeneralPuzzlesInfo(): array
    {
        $puzzles = $this->puzzlesGeneralMongoCollection->getPuzzles(); 
        foreach($puzzles as &$puzzle) {
            $routeName = $puzzle['key'];
            $puzzle['url'] = route("$routeName.index");
        }

        return $puzzles;
    }
}