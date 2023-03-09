<?php 

declare(strict_types=1); 

if (! function_exists('get_component_path')) {
    
    /** @return array<string,string> */
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

/** 
 *  if executed outside the object 
 *  then only public and non-static properties and methods will be checked
 */
if (! function_exists('is_object_empty')) {
    function is_object_empty(object $object): bool
    {
        return empty(get_object_vars($object)) && empty(get_class_methods($object));
    }
}