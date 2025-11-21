<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Halaman daftar semua kategori
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('users.category.index', compact('categories'));
    }

    // Halaman buku berdasarkan kategori
    public function show(Category $category)
    {
        // ambil buku-buku yang punya category_id = kategori ini
        $books = $category->books()->with('category')->get();

        return view('users.category.show', compact('category', 'books'));
    }
}
