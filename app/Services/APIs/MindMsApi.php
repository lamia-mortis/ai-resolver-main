<?php 

declare(strict_types=1);

namespace App\Services\APIs;

use App\Services\Enums\MicroServices;

class MindMsApi extends AbstractApi 
{
    public const SERVICE_KEY = MicroServices::MIND->value;

    protected static function createOrigin() :string 
    {
        $mindMsUrlConfig = config('services')[self::SERVICE_KEY]['url'];
        return $mindMsUrlConfig['protocol'] . '://' 
             . $mindMsUrlConfig['host']  . ':'
             . $mindMsUrlConfig['port'];
    }

    protected function createUrl(string $path): string 
    {
        return $this->origin . '/api' . $path;
    }
}