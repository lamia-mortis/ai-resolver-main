<?php

declare(strict_types=1);

namespace App\Services; 

use App\DbGateway\FlexibleConfigCollection; 
use App\Services\Enums\FlexibleConfigs;

class FlexibleConfigService 
{
    public function __construct(
        protected FlexibleConfigCollection $flexibleConfigCollection
    ) {} 

    public function getCommonSection(): array
    {
        // trying to get the first array element with reset()
        $sectionSettings = $this->flexibleConfigCollection->getCommonSection(); 
        $sectionSettings = reset($sectionSettings) ==! false ? reset($sectionSettings) : [];
        
        return !empty($sectionSettings) && isset($sectionSettings[FlexibleConfigs::COMMON_SECTION->value]) 
            ? (array)json_decode($sectionSettings[FlexibleConfigs::COMMON_SECTION->value]) 
            : [];
    }

    public function updateCommonSection(array $newSectionSettings): bool 
    {
        return !empty($newSectionSettings) 
            ? $this->flexibleConfigCollection->updateCommonSection([
                  FlexibleConfigs::COMMON_SECTION->value => json_encode($newSectionSettings),
              ])
            : false;
    }

    public function getAllSections(): array 
    {
        $allSectionsConfig = $this->flexibleConfigCollection->getAllSections();
        
        return empty($allSectionsConfig) 
            ? []
            : array_map(
                static fn($sectionSettings) => json_decode($sectionSettings), 
                ...$allSectionsConfig
              );
    }
}