<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Tampilkan daftar buku
    public function index()
    {
        // eager load category untuk menghindari N+1
        $books = Book::with('category')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    // Tampilkan form create
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    // Simpan data buku baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    // Update data buku
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Kalau upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }

            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diupdate.');
    }

    // Hapus buku
    public function destroy(Book $book)
    {
        // Hapus gambar dari storage
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
