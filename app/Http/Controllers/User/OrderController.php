<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // daftar semua order milik user yang login
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.orders.index', compact('orders'));
    }

    // detail satu order
    public function show(Order $order)
    {
        // pastikan order ini milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.book');

        return view('users.orders.show', compact('order'));
    }
}
