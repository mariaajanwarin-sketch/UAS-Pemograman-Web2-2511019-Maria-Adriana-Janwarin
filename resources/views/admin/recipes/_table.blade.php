<table>
    <thead>
        <tr><th>Judul</th><th>Kategori</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse($recipes as $recipe)
            <tr>
                <td>{{ $recipe->judul }}</td>
                <td>{{ $recipe->category->nama }}</td>
                <td class="act">
                    <a href="{{ route('admin.recipes.edit', $recipe) }}">Edit</a> ·
                    <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}"
                          onsubmit="return confirm('Hapus resep ini?')">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada resep. Klik Tambah Resep untuk memulai.</td></tr>
        @endforelse
    </tbody>
</table>
