@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
@endsection

@section('content')

<main class="content-wrapper" style="max-width: 1000px; margin: 20px auto 40px;">
    <a href="{{ route('users.orders.index') }}" style="display:inline-block; margin-bottom:12px;">
        ← Back to Order History
    </a>

    <div style="background:#fff; border-radius:16px; padding:20px; box-shadow:0 8px 25px rgba(15,23,42,0.08);">
        <h1 style="margin-bottom:10px;">Order #{{ $order->id }}</h1>
        <p style="margin-bottom:4px;">Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p style="margin-bottom:4px;">Status: <strong>{{ ucfirst($order->status) }}</strong></p>

        <hr style="margin:16px 0;">

        <h2 style="font-size:1.1rem; margin-bottom:8px;">Shipping Information</h2>
        <p>Name: {{ $order->fullname }}</p>
        <p>Address: {{ $order->address }}</p>
        <p>City / Postal Code: {{ $order->city }} {{ $order->postal_code }}</p>
        <p>Phone: {{ $order->phone }}</p>
        <p>Email: {{ $order->email }}</p>

        <hr style="margin:16px 0;">

        <h2 style="font-size:1.1rem; margin-bottom:8px;">Items</h2>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="text-align:left; padding:6px 4px;">Book</th>
                    <th style="text-align:right; padding:6px 4px;">Price</th>
                    <th style="text-align:center; padding:6px 4px;">Qty</th>
                    <th style="text-align:right; padding:6px 4px;">Subtotal</th>
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

        <div style="text-align:right; margin-top:12px;">
            <p>Subtotal: <strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong></p>
            <p>Shipping: <strong>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</strong></p>
            <p>Total: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>
        </div>
    </div>
</main>
@endsection
