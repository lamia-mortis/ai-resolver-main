<?php

declare(strict_types=1);

namespace App\DbGateway; 

use App\Services\DTOs\FlexibleConfig\CommonConfigData;
use Illuminate\Support\Facades\DB; 
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use App\Services\Enums\FlexibleConfigs;
use Illuminate\Support\Facades\Log;
use Throwable;

class FlexibleConfigCollection 
{
    private const MONGO_COLLECTION_NAME = FlexibleConfigs::ALL->value; 

    /** 
     * @param array<string:JsonString> 
     */
    public function updateCommonSection(array $newCommonConfig): bool 
    {
        try {
            DB::table(self::MONGO_COLLECTION_NAME)
                ->updateOrInsert([], $newCommonConfig);

            return true;    
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
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
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }
}