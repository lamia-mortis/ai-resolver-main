<?php 

declare(strict_types=1);

use App\Services\Enums\FlexibleConfigs;

return [

    FlexibleConfigs::COMMON_SECTION->value => [
        
        FlexibleConfigs::LOGGING->value => [

            /* 
            /  option determines on which side front-end logs shoul be processed: 
            /  on server or just shown in the browser console
            */
            FlexibleConfigs::SERVER_SIDE->value => false,
        ],
    ],
];