<?php 

declare(strict_types=1); 

if (! function_exists('get_component_path')) {
    
    /** @return array{string,string} */
    function get_component_path(string $componentKey, string $requestType): array
    {
        $delimiter = strpos($componentKey, '-') === false ? '_' : '-';
        $pathToComponent = implode(array_map('ucfirst', explode($delimiter, $componentKey)));
        $componentName = $pathToComponent . ucfirst($requestType);

        return [$pathToComponent, $componentName];
    }
}

if (! function_exists('is_nested_object_valid')) {
    function is_nested_object_valid(object $object, array $keys): bool
    {
        return empty(
            array_filter($keys, static fn($key) => !property_exists($object, $key))
        );
    }
}