<?php

declare(strict_types=1);

namespace App\Services; 

use App\DbGateway\FlexibleConfigCollection; 
use App\Services\Enums\FlexibleConfigs;
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;

class FlexibleConfigService 
{
    public function __construct(
        protected FlexibleConfigCollection $flexibleConfigCollection
    ) {} 

    public function updateCommonSection(array $newSectionSettings): bool 
    {
        return !empty($newSectionSettings) 
            ? $this->flexibleConfigCollection->updateCommonSection([
                  FlexibleConfigs::COMMON_SECTION->value => json_encode($newSectionSettings),
              ])
            : false;
    }

    public function getAllSections(): FlexibleConfigData 
    {
        return $this->flexibleConfigCollection->getAllSections();
    }
}