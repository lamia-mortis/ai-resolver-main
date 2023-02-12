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
        <header>
            <div class="px-3 py-2 text-bg-dark">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a id="puzzles-navbar-button" href="javascript:void(0)" class="nav-link text-white">What to solve?</a> 
                                <div id="puzzles-navbar-container"></div>
                            </li>
                            <li>
                                <a id="algoritms-navbar-button" href="javascript:void(0)" class="nav-link text-secondary">Algorithms</a>
                            </li>
                            <li>
                                <a id="history-navbar-button" href="javascript:void(0)" class="nav-link text-secondary">History</a>
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
            @inertia
        </main>
        <footer></footer>
    </body>
</html>