<?php

declare(strict_types=1);

namespace App\Services\DTOs;

use Illuminate\Http\Request;

interface DataInterface 
{
    public static function fromRequest(Request $request): DataInterface; 

    public static function fromArray(array $data): DataInterface;

    public static function fromObject(object $data): DataInterface;

    public function toArray(): array;
}