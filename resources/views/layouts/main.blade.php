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
    <body class="bg-dark">
        <header>
            <div class="px-3 py-2 text-bg-dark">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href="javascript:void(0)" class="nav-link text-white">What to solve?</a> 
                                <div>
                                    <ul>
                                        {{-- todo make list generated dinamical from the DB --}}
                                        <li>Cube</li>
                                        <li>Sudoku</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="nav-link text-secondary">Algorithms</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="nav-link text-secondary">Placeholder</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="nav-link text-secondary">Placeholder</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="nav-link text-secondary">Placeholder</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="ai-main-container container">
                @yield('content')
            </div>
        </main>
        <footer></footer>
    </body>
</html>