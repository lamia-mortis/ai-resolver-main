<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Enums\FlexibleConfigs;
use App\Services\FlexibleConfigService;
use App\Http\Requests\FlexibleConfigRequest;
use Illuminate\Http\JsonResponse;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Throwable;

class FlexibleConfigController extends Controller
{
    public function __construct(
        protected FlexibleConfigService $flexibleConfigService
    ) {}

    /**
     * default properties of the props:[] see in HandleInertiaRequest share() method
     * @return \Inertia\Response{
     *              component:string,
     *              props:array<
     *                  flexibleConfigUpdateUrl:  string,
     *                  flexible_config:          \App\Services\DTOs\FlexibleConfig\FlexibleConfigData|stdClass{},
     *              >,
     *         }
     */
    public function index(): InertiaResponse 
    {
        [$componentPath, $componentName] = get_component_path(FlexibleConfigs::all(), __FUNCTION__);

        return Inertia::render("$componentPath/$componentName", [
            'flexibleConfigUpdateUrl' => route(FlexibleConfigs::all() . '.update'),
            FlexibleConfigs::all()    => $this->flexibleConfigService->getAllSections(), 
        ]);
    }

    /**
     * @var array<common_config:array<logging:array<server_side:bool>>> $requestData
     * @return JsonResponse{array<success:bool>,?int}
     */
    public function update(FlexibleConfigRequest $request): JsonResponse
    {
        try {
            $isSuccess = $this->flexibleConfigService->updateCommonSection($request->getFilledDto()->getCommonConfig());
            return response()->json(['success' => $isSuccess]);
        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return response()->json(['success' => false], 500);
        }
    }
}
