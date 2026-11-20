@extends('layouts.app')
@section('title', 'Daftar Resep')

@section('content')
    <h1>Daftar Resep</h1>

    <form class="search" method="GET" action="{{ route('recipes.index') }}">
        @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari resep">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>

    <div class="pills" id="kategori">
        <a class="pill {{ request('kategori') ? '' : 'active' }}"
           href="{{ route('recipes.index', array_filter(['q' => request('q')])) }}">Semua</a>
        @foreach($categories as $category)
            <a class="pill {{ request('kategori') == $category->id ? 'active' : '' }}"
               href="{{ route('recipes.index', array_filter(['q' => request('q'), 'kategori' => $category->id])) }}">
                {{ $category->nama }}
            </a>
        @endforeach
    </div>

    <div class="grid">
        @forelse($recipes as $recipe)
            <a class="card" href="{{ route('recipes.show', $recipe) }}">
                <div class="photo">
                    @if($recipe->gambar_url)
                        <img src="{{ $recipe->gambar_url }}" alt="{{ $recipe->judul }}" loading="lazy">
                    @else
                        <span class="emoji" aria-hidden="true">{{ $recipe->emoji }}</span>
                    @endif
                </div>
                <div class="body">
                    <h3>{{ $recipe->judul }}</h3>
                    <small>{{ $recipe->category->nama }} · {{ $recipe->waktu_format }}</small>
                </div>
            </a>
        @empty
            <p class="empty">Belum ada resep yang cocok. Coba kata kunci atau kategori lain.</p>
        @endforelse
    </div>

    {{ $recipes->links('vendor.pagination.katalog') }}
@endsection
