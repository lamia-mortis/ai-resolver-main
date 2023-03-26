<?php 

declare(strict_types=1);

namespace App\Factories; 

use Illuminate\Http\Request;
use App\Services\DTOs\SudokuData;  

class SudokuFactory extends AbstractServiceFactory 
{
    public static function createDto(object|array $data): SudokuData
    {
        return match(true) {
            $data instanceof Request   => SudokuData::fromRequest($data), 
            is_object($data)           => SudokuData::fromObject($data), 
            default                    => SudokuData::fromArray($data),
        };
    }
}