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
            FlexibleConfigs::serverSide() => ['boolean'],
        ];
    }
    
    protected function map(array $data): bool 
    {
        try {
            $this->server_side = $data[FlexibleConfigs::serverSide()];
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
                FlexibleConfigs::serverSide() 
                    => $data->{FlexibleConfigs::serverSide()},
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::serverSide() 
                    => $request->get(FlexibleConfigs::serverSide()),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new static(
            [
                FlexibleConfigs::serverSide() 
                    => $data[FlexibleConfigs::serverSide()],
            ]
        );
    } 

    public function toArray(): array 
    {
        return [
            FlexibleConfigs::serverSide() => $this->server_side,
        ];
    }

    public function getServerSide(): bool 
    {
        return $this->server_side;
    }
}