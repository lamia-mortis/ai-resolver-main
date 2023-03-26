<?php 

declare(strict_types=1);

namespace App\Services\APIs;

interface ApiInterface 
{
    public const SERVICE_KEY = '';

    public function send(string $method, string $path, array $data): array;
}