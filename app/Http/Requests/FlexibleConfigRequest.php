<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Factories\FlexibleConfigFactory;

class FlexibleConfigRequest extends GlobalRequest
{
    protected function getDtoFactory(): string 
    {
        return FlexibleConfigFactory::class;
    }

    /**
     * @return array<string:string[]>
     */
    public function rules(): array
    {
        return [
            'common_config.logging.server_side' => ['required', 'boolean'],
        ];
    }
}
