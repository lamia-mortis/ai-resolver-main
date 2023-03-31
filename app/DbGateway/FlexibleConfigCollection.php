<?php

declare(strict_types=1);

namespace App\DbGateway; 

use App\Services\DTOs\FlexibleConfig\CommonConfigData;
use Illuminate\Support\Facades\DB; 
use App\Services\DTOs\FlexibleConfig\FlexibleConfigData;
use App\Services\Enums\FlexibleConfigs;
use Illuminate\Support\Facades\Log;
use stdClass;
use Throwable;

class FlexibleConfigCollection 
{
    /** 
     * @param array<string:JsonString> 
     */
    public function updateCommonSection(array $newCommonConfig): bool 
    {
        try {
            DB::table(FlexibleConfigs::all())
                ->updateOrInsert([], $newCommonConfig);

            return true;    
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return false;
        }
    }

    public function getAllSections(): FlexibleConfigData|stdClass
    {
        try{
            return DB::table(FlexibleConfigs::all())
                       ->select('*')
                       ->limit(1)
                       ->get()
                       ->fromJson(FlexibleConfigs::common())
                       ->fillWithDto(FlexibleConfigs::all())
                       ->first();            
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return new stdClass();
        }
    }
}