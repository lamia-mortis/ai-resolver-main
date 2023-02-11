<?php

declare(strict_types=1);

namespace App\DbGateway; 

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use App\Services\Enums\FlexibleConfigs;
use Throwable;

class FlexibleConfigCollection 
{
    private const MONGO_COLLECTION_NAME = 'flexible_config'; 

    public function getCommonSection(): array 
    {
        try {
            $data = DB::table(self::MONGO_COLLECTION_NAME)
                        ->select(FlexibleConfigs::COMMON_SECTION->value)
                        ->limit(1)
                        ->get()
                        ->toArray();

            return filter_mongo_id($data);  
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

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

    public function getAllSections(): array 
    {
        try{
            $data = DB::table(self::MONGO_COLLECTION_NAME)
                        ->select('*')
                        ->limit(1)
                        ->get()
                        ->toArray();

            return filter_mongo_id($data);           
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}