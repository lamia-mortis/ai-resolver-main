<?php 

declare(strict_types=1);

namespace App\Factories; 

use App\Services\DTOs\PuzzleData; 
use Illuminate\Http\Request; 

class PuzzleFactory extends AbstractServiceFactory 
{
    public static function createDto(object|array $data): PuzzleData
    {
        return match(true) {
            $data instanceof Request   => PuzzleData::fromRequest($data), 
            is_object($data)           => PuzzleData::fromObject($data), 
            default                    => PuzzleData::fromArray($data),
        };
    }
}