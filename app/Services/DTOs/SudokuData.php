<?php

declare(strict_types=1);

namespace App\Services\DTOs; 

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;

class SudokuData extends AbstractData
{
    /* default DTO properties, that are always returned */
    public readonly array $board;
    public readonly int   $squareSize;

    /**
     * @return array<string:array<mixed>>
     */
    protected function validationRules(): array 
    {
        return [
            'board'     => [
                'required', 
                'array', 
                static fn($attribute, $value, $fail) => 
                    count($value) === 9 
                        ?: $fail("The $attribute in DTO is invalid"),
            ],
            'board.*'    => [
                'required', 
                'array',
                static fn($attribute, $value, $fail) => 
                    count($value) === 9 
                        ?: $fail("Rows of the board in DTO are invalid"),
            ],
            'board.*.*'  => ['required', 'regex:/[0-9]/'],
            'squareSize' => ['required', 'regex:/[123]/'],
        ];
    }

    protected function map(array $data): bool 
    {
        try {
            $this->board = $data['board'];
            $this->squareSize = $data['squareSize'];
            return true;
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return false;
        }
    }

    public static function fromObject(object $data): DataInterface 
    {
        return new self(
            [
                'board'      => $data->board, 
                'squareSize' => $data->squareSize,
            ]
        );
    }

    public static function fromRequest(Request $request): DataInterface 
    {
        return new self(
            [
                'board'      => $request->get('board'), 
                'squareSize' => $request->get('squareSize'),
            ]
        );
    }

    public static function fromArray(array $data): DataInterface 
    {
        return new self(
            [
                'board'      => $data['board'] ?? '', 
                'squareSize' => $data['squareSize'] ?? '',
            ]
        );
    }

    public function toArray(): array
    {
        return [
            'board' => $this->board, 
            'squareSize' => $this->squareSize,
        ];
    }
}