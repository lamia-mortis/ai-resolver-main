<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData; 
use App\Services\DTOs\DataInterface;
use App\Services\Enums\FlexibleConfigs; 
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;

class SharedFlexibleConfigData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly LoggingData $logging;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::LOGGING->value => [
                'required',
                static function($attribute, $value, $fail) {
                    is_object($value) && $value instanceof LoggingData 
                        ?: $fail("The $attribute in DTO is not the required object");

                    is_nested_object_valid($value, [FlexibleConfigs::SERVER_SIDE->value]) 
                        ?: $fail("The $attribute in DTO has invalid inner structure");
                },
            ],
        ];
    }

    protected function map(array $data): bool 
    {
        try {
            $this->logging = $data[FlexibleConfigs::LOGGING->value];
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
                FlexibleConfigs::LOGGING->value 
                    => $data->{FlexibleConfigs::LOGGING->value},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::LOGGING->value 
                    => $request->get(FlexibleConfigs::LOGGING->value),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::LOGGING->value 
                    => $data[FlexibleConfigs::LOGGING->value],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::LOGGING->value => $this->logging->toArray(),
        ];
    }

}