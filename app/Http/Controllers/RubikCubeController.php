<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response as InertiaResponse;
use App\Services\PuzzlesGeneralService; 
use App\Services\Enums\Puzzles; 
use Inertia\Inertia;

class RubikCubeController extends Controller
{
    private const PUZZLE_KEY = Puzzles::RUBIK_CUBE->value;

    /**
     * default properties of the props:array see in HandleInertiaRequest share() method
     * @return \Inertia\Response{component:string,props:array}
     */
    public function index(): InertiaResponse
    {
        [$componentPath, $componentName] = get_component_path(self::PUZZLE_KEY, __FUNCTION__);
        return Inertia::render("$componentPath/$componentName");
    }
}