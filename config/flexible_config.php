<?php 

declare(strict_types=1);

use App\Services\Enums\FlexibleConfigs;

return [

    FlexibleConfigs::common() => [
        
        FlexibleConfigs::logging() => [

            /* 
            /  option determines on which side front-end logs shoul be processed: 
            /  on server or just shown in the browser console
            */
            FlexibleConfigs::serverSide() => false,
        ],
    ],
];