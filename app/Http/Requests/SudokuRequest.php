<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Factories\SudokuFactory;

class SudokuRequest extends GlobalRequest
{
    protected function getDtoFactory(): string 
    {
        return SudokuFactory::class;
    }

    /**
     * @return array<string:array<mixed>>
     */
    public function rules()
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
        ];;
    }
}
