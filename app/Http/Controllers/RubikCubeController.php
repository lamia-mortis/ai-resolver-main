<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response as InertiaResponse;
use App\Services\PuzzlesGeneralService; 
use App\Services\Enums\Puzzles; 
use Inertia\Inertia;

class RubikCubeController extends Controller
{
    /**
     * default properties of the props:array see in HandleInertiaRequest share() method
     * @return \Inertia\Response{component:string,props:array}
     */
    public function index(): InertiaResponse
    {
        [$componentPath, $componentName] = get_component_path(Puzzles::rubikCube(), __FUNCTION__);
        return Inertia::render("$componentPath/$componentName");
    }
}