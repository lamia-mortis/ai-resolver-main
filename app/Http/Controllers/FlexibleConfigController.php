<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Enums\FlexibleConfigs;
use App\Services\FlexibleConfigService;
use App\Services\PuzzlesGeneralService;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class FlexibleConfigController extends Controller
{
    public function __construct(
        protected FlexibleConfigService $flexibleConfigService
    ) {}

    /**
     * default properties of the props:[] see in HandleInertiaRequest share() method
     * @return \Inertia\Response{
     *              component:string,
     *              props:array{
     *                  flexibleConfigUpdateUrl:  string,
     *                  flexible_config:          \App\Services\DTOs\FlexibleConfig\FlexibleConfigData,
     *              },
     *         }
     */
    public function index(PuzzlesGeneralService $puzzlesGeneralService): InertiaResponse 
    {
        [$componentPath, $componentName] = get_component_path(FlexibleConfigs::ALL->value, __FUNCTION__);

        return Inertia::render("$componentPath/$componentName", [
            FlexibleConfigs::ALL->value => $this->flexibleConfigService->getAllSections(), 
            'flexibleConfigUpdateUrl'   => route(FlexibleConfigs::ALL->value . '.update'),
        ]);
    }

    public function update(Request $request)
    {
        $request->input();
    }
}
