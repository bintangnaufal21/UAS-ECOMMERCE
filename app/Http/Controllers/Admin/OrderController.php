<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.book'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // ===== METHOD BARU UNTUK EDIT STATUS =====
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,completed,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
