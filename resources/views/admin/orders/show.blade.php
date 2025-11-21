@extends('layouts.layoutAdmin')

@section('title', 'Order Detail')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/orders.css') }}">
@endsection

@section('content')
<header class="navbar">
    <div class="navbar-content">
        <h1>Order #{{ $order->id }}</h1>
        <div class="user-info">
            <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</header>

<main class="main-content" style="padding: 20px; max-width: 1100px; margin: 0 auto 40px;">

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div style="background:#dcfce7; border:1px solid #22c55e; color:#166534; padding:8px 12px; border-radius:8px; margin-bottom:12px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- INFO + FORM STATUS --}}
    <div style="display:grid; grid-template-columns: minmax(0,1.4fr) minmax(0,1fr); gap:20px; margin-bottom:20px;">
        <section class="order-info-card" style="background:#fff; border-radius:14px; padding:14px 16px; box-shadow:0 4px 12px rgba(15,23,42,0.08);">
            <h2 style="font-size:1.1rem; margin-bottom:8px;">Informasi Order</h2>
            <p><strong>User:</strong> {{ $order->user->name ?? '-' }} (ID: {{ $order->user_id }})</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            <p><strong>Metode Pengiriman:</strong> {{ strtoupper($order->shipping_method ?? '-') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method ?? '-') }}</p>
        </section>

        {{-- FORM EDIT STATUS --}}
        <section class="order-info-card" style="background:#fff; border-radius:14px; padding:14px 16px; box-shadow:0 4px 12px rgba(15,23,42,0.08);">
            <h2 style="font-size:1.1rem; margin-bottom:8px;">Status Pesanan</h2>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom:8px;">
                    <label for="status"><strong>Status Saat Ini:</strong></label><br>
                    <select id="status" name="status"
                            style="margin-top:4px; padding:6px 10px; border-radius:8px; border:1px solid #d1d5db;">
                        <option value="pending"   {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shipped"   {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled"  {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    @error('status')
                        <div style="color:#b91c1c; font-size:0.85rem; margin-top:2px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                        style="margin-top:6px; padding:8px 16px; border-radius:999px; border:none; cursor:pointer; background:#22c55e; color:#fff; font-weight:600; font-size:0.9rem;">
                    Update Status
                </button>
            </form>
        </section>
    </div>

    {{-- DATA PENGIRIMAN --}}
    <section style="background:#fff; border-radius:14px; padding:14px 16px; box-shadow:0 4px 12px rgba(15,23,42,0.08); margin-bottom:20px;">
        <h2 style="font-size:1.1rem; margin-bottom:8px;">Data Pengiriman</h2>
        <p><strong>Nama:</strong> {{ $order->fullname }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
        <p><strong>Kota / Kode Pos:</strong> {{ $order->city }} {{ $order->postal_code }}</p>
        <p><strong>Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
    </section>

    {{-- ITEM PESANAN --}}
    <section style="background:#fff; border-radius:14px; padding:14px 16px; box-shadow:0 4px 12px rgba(15,23,42,0.08);">
        <h2 style="font-size:1.1rem; margin-bottom:8px;">Item Pesanan</h2>

        <table style="width:100%; border-collapse:collapse; font-size:0.95rem;">
            <thead>
                <tr>
                    <th style="text-align:left; padding:6px 4px; border-bottom:1px solid #e5e7eb;">Buku</th>
                    <th style="text-align:right; padding:6px 4px; border-bottom:1px solid #e5e7eb;">Harga</th>
                    <th style="text-align:center; padding:6px 4px; border-bottom:1px solid #e5e7eb;">Qty</th>
                    <th style="text-align:right; padding:6px 4px; border-bottom:1px solid #e5e7eb;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td style="padding:6px 4px;">{{ $item->title }}</td>
                        <td style="padding:6px 4px; text-align:right;">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td style="padding:6px 4px; text-align:center;">{{ $item->qty }}</td>
                        <td style="padding:6px 4px; text-align:right;">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align:right; margin-top:10px;">
            <p>Subtotal: <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong></p>
            <p>Shipping: <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong></p>
            <p>Total: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>
        </div>
    </section>

</main>
@endsection
