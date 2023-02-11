<?php 

declare(strict_types=1); 

if (! function_exists('get_component_path')) {
    function get_component_path(string $componentKey, string $requestType): array
    {
        $delimiter = strpos($componentKey, '-') === false ? '_' : '-';
        $pathToComponent = implode(array_map('ucfirst', explode($delimiter, $componentKey)));
        $componentName = $pathToComponent . ucfirst($requestType);

        return [$pathToComponent, $componentName];
    }
}

if (! function_exists('filter_mongo_id')) {
    function filter_mongo_id(array $mongoData): array
    {
        foreach($mongoData as &$row) {
            unset($row['_id']);
        } 
        
        return $mongoData;
    }
}