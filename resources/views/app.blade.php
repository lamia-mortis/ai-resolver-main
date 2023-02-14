<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @viteReactRefresh
        @vite(['resources/scss/app.scss', 'resources/js/app.tsx']) 
        @inertiaHead
    </head> 
    <body class="bg-dark">
        @inertia
    </body>
</html>