<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Katalog Resep')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
</head>
<body>
    <header class="nav">
        <a class="brand" href="{{ route('recipes.index') }}">Katalog Resep</a>
        <nav>
            <ul>
                <li><a href="{{ route('recipes.index') }}">Beranda</a></li>
                <li><a href="{{ route('recipes.index') }}">Resep</a></li>
                <li><a href="{{ route('recipes.index') }}#kategori">Kategori</a></li>
                @auth
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @else
                    <li><a href="{{ url('/login') }}">Masuk</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>