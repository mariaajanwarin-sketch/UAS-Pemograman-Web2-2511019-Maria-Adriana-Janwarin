@extends('layouts.app')
@section('title', $recipe->judul)

@section('content')
    <article class="detail">
        <div class="cover">
            @if($recipe->gambar_url)
                <img src="{{ $recipe->gambar_url }}" alt="{{ $recipe->judul }}">
            @else
                <span class="emoji" aria-hidden="true">{{ $recipe->emoji }}</span>
            @endif
        </div>

        <h1>{{ $recipe->judul }}</h1>
        <p class="meta">{{ $recipe->category->nama }} · {{ $recipe->waktu_format }}</p>

        @if($recipe->deskripsi)
            <p class="lead">{{ $recipe->deskripsi }}</p>
        @endif

        <div class="detail-cols">
            <section>
                <h2>Bahan</h2>
                <ul>
                    @foreach($recipe->daftar_bahan as $bahan)<li>{{ $bahan }}</li>@endforeach
                </ul>
            </section>
            <section>
                <h2>Langkah memasak</h2>
                <ol>
                    @foreach($recipe->daftar_langkah as $langkah)<li>{{ $langkah }}</li>@endforeach
                </ol>
            </section>
        </div>

        <p style="margin-top:2.5rem"><a class="btn" href="{{ route('recipes.index') }}">Kembali ke daftar resep</a></p>
    </article>
@endsection
