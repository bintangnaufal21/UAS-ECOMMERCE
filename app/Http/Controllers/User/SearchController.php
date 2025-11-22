<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->q;

        // Jika tidak ada query → redirect
        if (!$query) {
            return redirect()->route('users.dashboard');
        }

        // Cari judul mengandung query
        $books = Book::where('title', 'like', "%$query%")->get();

        return view('users.search.index', compact('books', 'query'));
    }
}
