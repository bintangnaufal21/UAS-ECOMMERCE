<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class GuestController extends Controller
{
    public function index(Book $book){
        $book = Book::all();
        return view('Dashboard', compact('book'));
    }
}
