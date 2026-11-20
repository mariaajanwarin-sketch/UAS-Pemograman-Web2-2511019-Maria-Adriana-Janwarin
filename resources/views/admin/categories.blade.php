@extends('admin.layout')
@section('title', 'Kelola Kategori')

@section('content')
    <h1>Kelola Kategori</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="search">
        @csrf
        <input type="text" name="nama" placeholder="Nama kategori baru" required>
        <button class="btn btn-primary" type="submit">Tambah</button>
    </form>

    <table>
        <thead><tr><th>Nama</th><th>Jumlah resep</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->nama }}</td>
                <td>{{ $category->recipes_count }}</td>
                <td class="act">
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                          onsubmit="return confirm('Hapus kategori ini beserta resepnya?')">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
