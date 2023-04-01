<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use App\Services\Enums\Puzzles; 
use App\Services\Enums\FlexibleConfigs;
use App\Factories\PuzzleFactory; 
use App\Factories\FlexibleConfigFactory;
use stdClass;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('fillWithDto', function(string $dtoType): Collection 
        {
            $factory = match($dtoType) {
                Puzzles::all()         => PuzzleFactory::class,
                FlexibleConfigs::all() => FlexibleConfigFactory::class,
            };

            return $this->map(
                fn(array $record) => $factory::createDto($record)
            );
        });

        Collection::macro('fromJson', function(string $column): Collection 
        {
            return $this->map(
                
                /** @property array<column:JsonString> $record */
                /** @return array<column:mixed|null> */
                function(array $record) use($column): array {
                    $record[$column] = isset($record[$column]) ? @json_decode($record[$column]) : null;
                    return $record;
                }
            );
        });
    }
}
