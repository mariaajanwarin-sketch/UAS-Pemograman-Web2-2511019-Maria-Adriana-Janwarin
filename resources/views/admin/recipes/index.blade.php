@extends('admin.layout')
@section('title', 'Kelola Resep')

@section('content')
    <div class="head-row">
        <h1 style="margin:0">Kelola Resep</h1>
        <a class="btn btn-primary" href="{{ route('admin.recipes.create') }}">Tambah Resep</a>
    </div>
    @include('admin.recipes._table', ['recipes' => $recipes])
    {{ $recipes->links('vendor.pagination.katalog') }}
@endsection
