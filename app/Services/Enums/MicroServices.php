<?php

declare(strict_types=1);

namespace App\Services\Enums; 

enum MicroServices: string {
    case MIND = 'mind_ms';

    public static function mind(): string 
    {
        return self::MIND->value;
    }
}