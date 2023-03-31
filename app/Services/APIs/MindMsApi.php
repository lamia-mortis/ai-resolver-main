<?php 

declare(strict_types=1);

namespace App\Services\APIs;

use App\Services\Enums\MicroServices;

class MindMsApi extends AbstractApi 
{
    protected static function createOrigin(): string 
    {
        $mindMsUrlConfig = config('services')[MicroServices::mind()]['url'];
        return $mindMsUrlConfig['protocol'] . '://' 
             . $mindMsUrlConfig['host']  . ':'
             . $mindMsUrlConfig['port'];
    }

    protected function createUrl(string $path): string 
    {
        return $this->origin . '/api' . $path;
    }
}