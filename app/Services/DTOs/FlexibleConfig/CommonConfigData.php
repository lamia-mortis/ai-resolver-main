<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData; 
use App\Services\DTOs\DataInterface;
use App\Services\Enums\FlexibleConfigs; 
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;

class CommonConfigData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly LoggingData $logging;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::logging() => [
                static fn($attribute, $value, $fail) => 
                    is_nested_object_valid((object)$value, [FlexibleConfigs::serverSide()]) 
                        ?: $fail("The $attribute in DTO is invalid"),
            ],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->logging = LoggingData::fromArray((array)$data[FlexibleConfigs::logging()]);
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
                FlexibleConfigs::logging() 
                    => $data->{FlexibleConfigs::logging()},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::logging() 
                    => $request->get(FlexibleConfigs::logging()),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::logging() 
                    => $data[FlexibleConfigs::logging()],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::logging() => $this->logging->toArray(),
        ];
    }

    public function getLogging(): LoggingData 
    {
        return $this->logging;
    }
}