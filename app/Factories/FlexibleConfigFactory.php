<?php 

declare(strict_types=1);

namespace App\Factories; 

use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use Illuminate\Http\Request; 

class FlexibleConfigFactory extends AbstractServiceFactory 
{
    public static function createDto(object|array $data): FlexibleConfigData
    {
        return match(true) {
            $data instanceof Request   => FlexibleConfigData::fromRequest($data), 
            is_object($data)           => FlexibleConfigData::fromObject($data), 
            default                    => FlexibleConfigData::fromArray($data),
        };
    }
}