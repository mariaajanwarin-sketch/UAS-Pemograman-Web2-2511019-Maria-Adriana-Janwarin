<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · Katalog Resep</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
</head>
<body>
<div class="admin">
    <aside class="sidebar">
        <div class="title">Admin</div>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.recipes.index') }}">Kelola Resep</a>
        <a href="{{ route('admin.categories.index') }}">Kelola Kategori</a>
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </aside>
    <section class="main">
        @if(session('sukses'))<div class="alert">{{ session('sukses') }}</div>@endif
        @yield('content')
    </section>
</div>
</body>
</html>
