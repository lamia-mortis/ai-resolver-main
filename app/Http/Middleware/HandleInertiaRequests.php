<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Services\PuzzlesGeneralService;
use App\Services\Enums\FlexibleConfigs;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * default properties of the props:[], that are always present in the server response
     * @return array{puzzles:\App\Services\DTOs\PuzzleData{url:string}[],flexibleConfigIndexUrl:string,errors:callable}
     */
    public function share(Request $request): array
    {
        $puzzlesGeneralService = app(PuzzlesGeneralService::class);
        
        return array_merge(parent::share($request), [
            'puzzles' => $puzzlesGeneralService->getGeneralPuzzlesInfo(),
            'flexibleConfigIndexUrl' => route(FlexibleConfigs::ALL->value . '.index'),
        ]);
    }
}
