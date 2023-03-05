<?php

declare(strict_types=1);

namespace App\Services\Enums; 

enum FlexibleConfigs: string 
{
    case COMMON_SECTION = 'common_config'; 
    case LOGGING = 'logging';
    case SERVER_SIDE = 'server_side';

    case ALL = 'flexible_config';
}