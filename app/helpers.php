<?php 

declare(strict_types=1); 

if (! function_exists('get_component_path')) {
    function get_component_path(string $componentKey, string $requestType) {
        $pathToComponent = implode(array_map('ucfirst', explode('-', $componentKey)));
        $componentName = $pathToComponent . ucfirst($requestType);

        return [$pathToComponent, $componentName];
    }
}