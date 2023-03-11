<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Services\PuzzlesGeneralService;
use App\Services\Enums\FlexibleConfigs;
use App\Services\FlexibleConfigService;

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
     * @return array<
     *             flexibleConfigIndexUrl:   string,
     *             puzzles:                  array<\App\Services\DTOs\PuzzleData{url:string}>,
     *             saveLogsUrl:              string,
     *             shared_flexible_config:   \App\Services\DTOs\FlexibleConfig\SharedFlexibleConfigData,
     *             errors:                   callable,
     *         >
     */
    public function share(Request $request): array
    {
        $puzzles = app(PuzzlesGeneralService::class)->getGeneralPuzzlesInfo();
        $sharedFlexibleConfig = app(FlexibleConfigService::class)->getAllSections()->getSharedParameters();
        array_filter($puzzles, static fn($puzzle) => is_object_empty($puzzle) ? false : $puzzle->getWithUrl());

        return array_merge(parent::share($request), [
            'flexibleConfigIndexUrl'                        => route(FlexibleConfigs::ALL->value . '.index'),
            'puzzles'                                       => $puzzles,
            'saveLogsUrl'                                   => route('app-state.save-logs'),
            FlexibleConfigs::SHARED_FLEXIBLE_CONFIG->value  => $sharedFlexibleConfig,
        ]);
    }
}
