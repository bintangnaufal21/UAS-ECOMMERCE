<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function show(Book $book)
    {
        // pastikan relasi kategori ikut di-load
        $book->load('category');

        return view('users.books.show', compact('book'));
    }
}
