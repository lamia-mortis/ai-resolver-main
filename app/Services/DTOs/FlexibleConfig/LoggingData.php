<?php

declare(strict_types=1);

namespace App\Services\DTOs\FlexibleConfig; 

use App\Services\DTOs\AbstractData;
use App\Services\Enums\FlexibleConfigs;
use App\Services\DTOs\DataInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class LoggingData extends AbstractData 
{
    /* default DTO properties, that are always returned */
    public readonly bool $server_side;

    protected function validationRules(): array
    {
        return [
            FlexibleConfigs::SERVER_SIDE->value => ['boolean'],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->server_side = $data[FlexibleConfigs::SERVER_SIDE->value];
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
                FlexibleConfigs::SERVER_SIDE->value 
                    => $data->{FlexibleConfigs::SERVER_SIDE->value},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::SERVER_SIDE->value 
                    => $request->get(FlexibleConfigs::SERVER_SIDE->value),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::SERVER_SIDE->value 
                    => $data[FlexibleConfigs::SERVER_SIDE->value],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::SERVER_SIDE->value => $this->server_side,
        ];
    }

    public function getServerSide(): bool 
    {
        return $this->server_side;
    }
}