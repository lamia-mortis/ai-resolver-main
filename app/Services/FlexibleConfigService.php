<?php

declare(strict_types=1);

namespace App\Services; 

use App\Services\DTOs\FlexibleConfig\CommonConfigData;
use App\DbGateway\FlexibleConfigTable; 
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use App\Services\Enums\FlexibleConfigs;
use stdClass;

class FlexibleConfigService 
{
    public function __construct(
        protected FlexibleConfigTable $flexibleConfigTable
    ) {} 

    public function updateCommonSection(CommonConfigData $newCommonConfig): bool 
    {
        return $this->flexibleConfigTable->updateCommonSection([
            FlexibleConfigs::common() => json_encode($newCommonConfig),
        ]);
    }

    public function getAllSections(): FlexibleConfigData|stdClass
    {
        return $this->flexibleConfigTable->getAllSections();
    }
}