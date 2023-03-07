<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\DTOs\DataInterface;
use Illuminate\Foundation\Http\FormRequest;

abstract class GlobalRequest extends FormRequest
{
    abstract protected function getDtoFactory(): string;

    public function authorize(): bool
    {
        return true;
    }
    
    public function getFilledDto(): DataInterface 
    {
        return $this->getDtoFactory()::createDto($this->all());
    }
}