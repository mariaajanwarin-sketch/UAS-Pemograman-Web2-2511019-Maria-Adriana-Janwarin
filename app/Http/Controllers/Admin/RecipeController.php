<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        return view('admin.recipes.index', [
            'recipes' => Recipe::with('category')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.recipes.form', [
            'recipe'     => new Recipe(),
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Recipe::slugUnik($data['judul']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        Recipe::create($data);

        return redirect()->route('admin.dashboard')->with('sukses', 'Resep berhasil disimpan.');
    }

    public function edit(Recipe $recipe)
    {
        return view('admin.recipes.form', [
            'recipe'     => $recipe,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $this->validated($request);
        $data['slug'] = Recipe::slugUnik($data['judul'], $recipe->id);

        if ($request->hasFile('gambar')) {
            if ($recipe->gambar) Storage::disk('public')->delete($recipe->gambar);
            $data['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $recipe->update($data);

        return redirect()->route('admin.dashboard')->with('sukses', 'Resep berhasil diperbarui.');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->gambar) Storage::disk('public')->delete($recipe->gambar);
        $recipe->delete();

        return back()->with('sukses', 'Resep dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul'       => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'deskripsi'   => 'nullable|string',
            'bahan'       => 'required|string',
            'langkah'     => 'required|string',
            'waktu_masak' => 'nullable|integer|min:1',
            'gambar'      => 'nullable|image|max:2048',
        ]);
    }
}
