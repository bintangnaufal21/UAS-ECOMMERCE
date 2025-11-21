<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // jumlah total buku
        $totalBooks  = Book::count();

        // jumlah total order
        $totalOrders = Order::count();

        // jumlah user (kalau kamu pakai role, bisa filter role = 'user')
        $totalUsers  = User::where('role', 'user')->count();

        // order terbaru (misal 5 terakhir)
        $orders = Order::latest()->take(5)->get();

        // jumlah pending orders untuk quick insights
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalOrders',
            'totalUsers',
            'orders',
            'pendingOrders',
        ));
    }
}
