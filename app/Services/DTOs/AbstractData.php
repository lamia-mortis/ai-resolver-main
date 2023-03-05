<?php

declare(strict_types=1);

namespace App\Services\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

abstract class AbstractData implements DataInterface 
{

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $data) 
    {
        try {
            if ($this->isValidData($data)) {
                if (!$this->map($data)) {
                    throw new InvalidArgumentException('The mapping failed');
                } 
            };
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }

    abstract protected function validationRules(): array;

    abstract protected function map(array $data): bool;

    abstract public static function fromObject(object $data): DataInterface;

    abstract public static function fromRequest(Request $request): DataInterface; 

    abstract public static function fromArray(array $data): DataInterface; 

    abstract public function toArray(): array;

    /**
     * @throws ValidationException
     */
    protected function isValidData(array $data): bool 
    {
        $validator = Validator::make(
            $data,
            $this->validationRules()
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            throw new ValidationException($validator);
        }

        return true;
    }
}