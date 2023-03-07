<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\DTOs\DataInterface;
use App\Services\Enums\FlexibleConfigs; 
use Throwable;

class CommonConfigData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly LoggingData $logging;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::LOGGING->value => [
                fn($attribute, $value, $fail) => 
                    is_nested_object_valid((object)$value, [FlexibleConfigs::SERVER_SIDE->value]) 
                        ?: $fail("The $attribute in DTO is invalid"),
            ],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->logging = LoggingData::fromArray((array)$data[FlexibleConfigs::LOGGING->value]);
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
            FlexibleConfigs::LOGGING->value => $this->logging,
        ];
    }
}