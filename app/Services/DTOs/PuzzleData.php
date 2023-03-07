<?php

declare(strict_types=1);

namespace App\Services\DTOs; 

use Illuminate\Http\Request;
use App\Services\Enums\Puzzles; 
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Log;
use stdClass;
use Throwable;

class PuzzleData extends AbstractData
{
    /* default DTO properties, that are always returned */
    public readonly string $key; 
    public readonly string $name; 

    /* optional DTO properties, should be listed explicitly */
    public readonly string $url;

    protected function validationRules(): array 
    {
        return [
            'key'  => ['required', 'string', 'max:255', 'min:1', new Enum(Puzzles::class), 'regex:/^[a-zA-Z0-9\-]+$/'], 
            'name' => ['required', 'string', 'max:255', 'min:1'],
        ];
    }

    protected function map(array $data): bool 
    {
        try {
            $this->key = $data['key'];
            $this->name = $data['name'];
            return true;
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return false;
        }
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new self(
            [
                'key' => $request->get('key'), 
                'name' => $request->get('name'),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new self(
            [
                'key' => $data['key'] ?? '', 
                'name' => $data['name'] ?? '',
            ]
        );
    }

    public static function fromObject(object $data): DataInterface
    {
        return new self(
            [
                'key' => $data->key, 
                'name' => $data->name,
            ]
        );
    }

    public function toArray(): array 
    {
        $result = [
            'key' => $this->key, 
            'name' => $this->name,
        ];

        if (!empty($this->url)) $result['url'] = $this->url;

        return $result;
    }

    public function getWithUrl(): DataInterface|stdClass
    {
        try {
            $this->url = route("$this->key.index");
            return $this;
        } catch(Throwable $exception) {
            Log::error($exception->getMessage());
            return new stdClass();
        } 
    }
}