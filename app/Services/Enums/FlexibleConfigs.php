<?php

declare(strict_types=1);

namespace App\Services\Enums; 

enum FlexibleConfigs: string 
{
    case COMMON = 'common_config'; 
    case LOGGING = 'logging';
    case SERVER_SIDE = 'server_side';

    case SHARED_FLEXIBLE_CONFIG = 'shared_flexible_config';
    case ALL = 'flexible_config';

    public static function common():string 
    {
        return self::COMMON->value;
    }

    public static function logging(): string 
    {
        return self::LOGGING->value;
    }

    public static function serverSide(): string 
    {
        return self::SERVER_SIDE->value;
    }

    public static function sharedFlexibleConfig(): string 
    {
        return self::SHARED_FLEXIBLE_CONFIG->value;
    }

    public static function all(): string 
    {
        return self::ALL->value;
    }
}