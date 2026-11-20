<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories', [
            'categories' => Category::withCount('recipes')->orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nama' => 'required|string|max:60|unique:categories,nama']);
        Category::create($data);

        return back()->with('sukses', 'Kategori ditambahkan.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('sukses', 'Kategori dihapus.');
    }
}
