@extends('layouts.app')
@section('title', $recipe->exists ? 'Edit Resep' : 'Tambah Resep')

@section('content')
    <h1>{{ $recipe->exists ? 'Edit Resep' : 'Tambah Resep' }}</h1>

    <form class="form" method="POST" enctype="multipart/form-data"
          action="{{ $recipe->exists ? route('admin.recipes.update', $recipe) : route('admin.recipes.store') }}">
        @csrf
        @if($recipe->exists) @method('PUT') @endif

        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $recipe->judul) }}" required>
        @error('judul')<div class="error">{{ $message }}</div>@enderror

        <label for="category_id">Kategori</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $recipe->category_id) == $category->id)>{{ $category->nama }}</option>
            @endforeach
        </select>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $recipe->deskripsi) }}</textarea>

        <label for="bahan">Bahan (satu per baris)</label>
        <textarea id="bahan" name="bahan" required>{{ old('bahan', $recipe->bahan) }}</textarea>
        @error('bahan')<div class="error">{{ $message }}</div>@enderror

        <label for="langkah">Langkah memasak</label>
        <textarea id="langkah" name="langkah" required>{{ old('langkah', $recipe->langkah) }}</textarea>
        @error('langkah')<div class="error">{{ $message }}</div>@enderror

        <label for="waktu_masak">Waktu masak (menit)</label>
        <input type="number" id="waktu_masak" name="waktu_masak" min="1" value="{{ old('waktu_masak', $recipe->waktu_masak) }}">

        <label for="gambar">Foto resep</label>
        <input class="file" type="file" id="gambar" name="gambar" accept="image/*">
        @error('gambar')<div class="error">{{ $message }}</div>@enderror

        <div class="actions">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn" href="{{ route('admin.dashboard') }}">Batal</a>
        </div>
    </form>
@endsection
