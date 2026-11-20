<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'jumlahResep'    => Recipe::count(),
            'jumlahKategori' => Category::count(),
            'jumlahPengguna' => User::count(),
            'resepTerbaru'   => Recipe::with('category')->latest()->take(5)->get(),
        ]);
    }
}
