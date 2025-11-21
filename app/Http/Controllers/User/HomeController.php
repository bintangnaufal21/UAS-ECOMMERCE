<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Homepage;

class HomeController extends Controller
{
    public function index()
    {
        // Buku best seller (yang dicentang di admin/homepages)
        $bestsellers = Book::with('category')
            ->where('is_bestseller', true)
            ->orderByRaw('COALESCE(bestseller_order, 9999)') // urut sesuai kolom order, yang kosong di belakang
            ->get();

        // Semua buku / buku terbaru (untuk section "Semua Buku")
        $books = Book::with('category')
            ->latest()
            ->get();

        // Optional: kalau mau pakai banner dari tabel homepages
        $homepage = Homepage::first();
        $bannerTitle = $homepage->banner_title ?? 'Selamat Datang di Bookstore';
        $bannerDesc  = $homepage->banner_desc ?? 'Temukan buku favoritmu di sini!';
        $bannerImage = $homepage->banner_image ?? null;

        return view('users.dashboard', compact(
            'bestsellers',
            'books',
            'bannerTitle',
            'bannerDesc',
            'bannerImage'
        ));
    }
}
