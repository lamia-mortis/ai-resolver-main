<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use App\Services\Enums\FlexibleConfigs;
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use Throwable;

class FlexibleConfigCollection 
{
    private const MONGO_COLLECTION_NAME = FlexibleConfigs::ALL->value; 

    public function updateCommonSection(array $newSectionSettings): bool 
    {
        try {
            DB::table(self::MONGO_COLLECTION_NAME)
                ->updateOrInsert([], $newSectionSettings);

            return true;    
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getAllSections(): FlexibleConfigData
    {
        try{
            return DB::table(self::MONGO_COLLECTION_NAME)
                       ->select('*')
                       ->limit(1)
                       ->get()
                       ->fromJson(FlexibleConfigs::COMMON_SECTION->value)
                       ->fillWithDto(self::MONGO_COLLECTION_NAME)
                       ->first();            
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}