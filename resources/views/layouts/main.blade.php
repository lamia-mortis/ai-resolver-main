<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @yield('title')
        </title>

        @viteReactRefresh
        @vite(['resources/scss/app.scss', 'resources/js/app.jsx'])
    </head> 
    <body> 
        <div class="ai-main-container container">
            @yield('content')
        </div>
    </body>
</html>