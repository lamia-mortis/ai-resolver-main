<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData; 
use App\Services\Enums\FlexibleConfigs; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\DTOs\DataInterface;
use Throwable;

class FlexibleConfigData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly CommonConfigData $common_config;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::COMMON_SECTION->value => [
                fn($attribute, $value, $fail) =>
                    is_nested_object_valid($value, [FlexibleConfigs::LOGGING->value]) 
                        ?: $fail("The $attribute is invalid"),
            ],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->common_config = $data[FlexibleConfigs::COMMON_SECTION->value];
            return true;
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public static function fromObject(object $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => CommonConfigData::fromObject($data->{FlexibleConfigs::COMMON_SECTION->value}),
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => CommonConfigData::fromObject((object)$request->get(FlexibleConfigs::COMMON_SECTION->value)),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => CommonConfigData::fromArray((array)$data[FlexibleConfigs::COMMON_SECTION->value]),
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::COMMON_SECTION->value => $this->common_config,
        ];
    }

    public function getCommonConfig(): CommonConfigData 
    {
        return $this->common_config;
    }
}