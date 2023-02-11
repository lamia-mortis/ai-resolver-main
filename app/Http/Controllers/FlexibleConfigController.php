<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Enums\FlexibleConfigs;
use App\Services\FlexibleConfigService;
use App\Services\PuzzlesGeneralService;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class FlexibleConfigController extends Controller
{
    public function __construct(
        protected FlexibleConfigService $flexibleConfigService
    ) {}

    public function index(PuzzlesGeneralService $puzzlesGeneralService): InertiaResponse 
    {
        [$componentPath, $componentName] = get_component_path(FlexibleConfigs::ALL->value, __FUNCTION__);

        return Inertia::render("$componentPath/$componentName", [
            'flexibleConfig' => $this->flexibleConfigService->getAllSections(),
        ]);
    }
}
