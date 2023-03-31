<?php

declare(strict_types=1);

namespace App\Services; 

use App\Services\DTOs\FlexibleConfig\CommonConfigData;
use App\DbGateway\FlexibleConfigCollection; 
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use App\Services\Enums\FlexibleConfigs;
use stdClass;

class FlexibleConfigService 
{
    public function __construct(
        protected FlexibleConfigCollection $flexibleConfigCollection
    ) {} 

    public function updateCommonSection(CommonConfigData $newCommonConfig): bool 
    {
        return $this->flexibleConfigCollection->updateCommonSection([
            FlexibleConfigs::common() => json_encode($newCommonConfig),
        ]);
    }

    public function getAllSections(): FlexibleConfigData|stdClass
    {
        return $this->flexibleConfigCollection->getAllSections();
    }
}