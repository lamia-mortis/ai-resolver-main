<?php 

declare(strict_types=1);

namespace App\Factories; 

use App\Services\DTOs\DataInterface;
use Illuminate\Http\Request;

abstract class AbstractServiceFactory implements ServiceFactoryInterface
{
    abstract public static function createDto(object|array $data): DataInterface;
}