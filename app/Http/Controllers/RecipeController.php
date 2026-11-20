<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $recipes = Recipe::with('category')
            ->when($request->q, fn ($q, $kata) => $q->where('judul', 'like', "%{$kata}%"))
            ->when($request->kategori, fn ($q, $id) => $q->where('category_id', $id))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('recipes.index', [
            'recipes'    => $recipes,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('category');
        return view('recipes.show', compact('recipe'));
    }
}
