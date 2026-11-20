@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <div class="stats">
        <div class="stat"><b>{{ $jumlahResep }}</b><span>Resep</span></div>
        <div class="stat"><b>{{ $jumlahKategori }}</b><span>Kategori</span></div>
        <div class="stat"><b>{{ $jumlahPengguna }}</b><span>Pengguna</span></div>
    </div>

    <div class="head-row">
        <h2>Resep Terbaru</h2>
        <a class="btn btn-primary" href="{{ route('admin.recipes.create') }}">Tambah Resep</a>
    </div>

    @include('admin.recipes._table', ['recipes' => $resepTerbaru])
@endsection
