<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData; 
use App\Services\DTOs\DataInterface;
use App\Services\Enums\FlexibleConfigs; 
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;

class FlexibleConfigData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly CommonConfigData $common_config;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::COMMON_SECTION->value => [
                static fn($attribute, $value, $fail) =>
                    is_nested_object_valid((object)$value, [FlexibleConfigs::LOGGING->value]) 
                        ?: $fail("The $attribute in DTO is invalid"),
            ],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->common_config = CommonConfigData::fromArray((array)$data[FlexibleConfigs::COMMON_SECTION->value]);
            return true;
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return false;
        }
    }

    public static function fromObject(object $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => $data->{FlexibleConfigs::COMMON_SECTION->value},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => $request->get(FlexibleConfigs::COMMON_SECTION->value),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::COMMON_SECTION->value 
                    => $data[FlexibleConfigs::COMMON_SECTION->value],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::COMMON_SECTION->value => $this->common_config->toArray(),
        ];
    }

    public function getCommonConfig(): CommonConfigData 
    {
        return $this->common_config;
    }

    public function getSharedParameters(): SharedFlexibleConfigData 
    {
        return SharedFlexibleConfigData::fromArray(
            [
                'logging' => $this->getCommonConfig()->getLogging(),
            ]
        );
    }
}