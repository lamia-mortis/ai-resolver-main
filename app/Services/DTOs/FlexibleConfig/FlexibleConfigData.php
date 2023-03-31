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
            FlexibleConfigs::common() => [
                static fn($attribute, $value, $fail) =>
                    is_nested_object_valid((object)$value, [FlexibleConfigs::logging()]) 
                        ?: $fail("The $attribute in DTO is invalid"),
            ],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->common_config = CommonConfigData::fromArray((array)$data[FlexibleConfigs::common()]);
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
                FlexibleConfigs::common() 
                    => $data->{FlexibleConfigs::common()},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::common() 
                    => $request->get(FlexibleConfigs::common()),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::common() 
                    => $data[FlexibleConfigs::common()],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::common() => $this->common_config->toArray(),
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