<!doctype html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SAIT Campaigns')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="navbar" id="navbar">
        <div class="container nav-inner">
            <a class="logo" href="{{ route('campanii.index') }}">+ SAIT Campaigns</a>

            <nav class="nav-links" id="navLinks">
                <a href="{{ route('campanii.index') }}#statistici">Statistici</a>
                <a href="{{ route('campanii.index') }}#campanii">Campanii</a>
                <a href="{{ route('campanii.index') }}#flux">Flux</a>
                <a href="{{ route('campanii.create') }}" class="btn btn-outline">Adauga campanie</a>
            </nav>

            <button class="burger" id="burger" type="button" aria-label="Meniu">&#9776;</button>
        </div>
    </header>

    <main>
        @if (session('status'))
            <div class="container flash-wrap">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <div class="footer-top">
                <a class="logo" href="{{ route('campanii.index') }}">+ SAIT Campaigns</a>
                <nav class="footer-links">
                    <a href="{{ route('campanii.index') }}#statistici">Statistici</a>
                    <a href="{{ route('campanii.index') }}#campanii">Campanii</a>
                    <a href="{{ route('campanii.index') }}#flux">Flux</a>
                    <a href="{{ route('campanii.create') }}">Campanie noua</a>
                </nav>
            </div>

            <div class="footer-mid">
                <div class="footer-contact">
                    <strong class="badge">Persistenta locala</strong>
                    <p>Aplicatia scrie toate datele in <code>database/database.sqlite</code>.</p>
                    <p>Poti verifica imediat inserarile, editarile si stergerile in SQL Studio.</p>
                </div>
                <div class="footer-note">
                    <p>Laravel CRUD refacut peste designul Positivus si adaptat pentru administrarea campaniilor.</p>
                </div>
            </div>
        </div>

        <div class="credit-bar">
            <div class="container">
                <p>SAIT CRUD · Laravel + Blade + SQLite</p>
            </div>
        </div>
    </footer>
</body>
</html>
