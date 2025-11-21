@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/orhis.css') }}">
@endsection

@section('content')

<style>
    .content-wrapper {
        max-width: 1100px;
        margin: 20px auto 40px;
        padding: 0 16px;
    }

    .order-history-container {
        background: transparent;
    }

    .oh-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .oh-header h1 {
        font-size: 1.7rem;
        margin-bottom: 4px;
    }

    .oh-header p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .order-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px 18px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 6px;
    }

    .order-card-header h2 {
        font-size: 1.1rem;
        margin-bottom: 2px;
    }

    .order-card-header p {
        margin: 0;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .order-status-badge {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
    }

    .status-pending   { background: #f97316; }  /* orange */
    .status-shipped   { background: #3b82f6; }  /* blue */
    .status-completed { background: #16a34a; }  /* green */
    .status-canceled  { background: #ef4444; }  /* red */

    .order-card-body p {
        margin: 0;
        font-size: 0.9rem;
    }

    .order-card-body p + p {
        margin-top: 2px;
    }

    .order-card-footer {
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
    }

    .order-card-footer .view-btn {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        background: #22c55e;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
    }

    .order-card-footer .view-btn:hover {
        background: #16a34a;
    }

    .empty-state {
        text-align: center;
        padding: 30px 18px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
    }

    .empty-state h2 {
        margin-bottom: 6px;
        font-size: 1.2rem;
    }

    .empty-state p {
        color: #6b7280;
        margin-bottom: 10px;
    }

    .empty-state .shop-now-btn {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 999px;
        background: #22c55e;
        color: #fff;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .empty-state .shop-now-btn:hover {
        background: #16a34a;
    }

    @media (max-width: 768px) {
        .order-card-header {
            flex-direction: column;
            gap: 6px;
        }

        .order-card-footer {
            justify-content: flex-start;
        }
    }
</style>

<main class="content-wrapper">
    <div class="order-history-container">

        <!-- Header -->
        <header class="oh-header">
            <h1>Your Order History</h1>
            <p>Track your past orders and their status.</p>
        </header>

        <main class="order-history-main">
            <section class="order-list-section" id="order-list-section">

                @if ($orders->isEmpty())
                    <div class="empty-state">
                        <h2>You haven’t placed any orders yet.</h2>
                        <p>Start shopping to see your order history here.</p>
                        <a href="{{ route('users.dashboard') }}" class="shop-now-btn">Start Shopping</a>
                    </div>
                @else
                    <div class="orders-list">
                        @foreach ($orders as $order)
                            @php
                                $statusClass = match (strtolower($order->status)) {
                                    'pending'   => 'status-pending',
                                    'shipped'   => 'status-shipped',
                                    'completed' => 'status-completed',
                                    'canceled'  => 'status-canceled',
                                    default     => 'status-pending',
                                };
                                $itemsCount = $order->items->sum('qty');
                            @endphp

                            <article class="order-card">
                                <div class="order-card-header">
                                    <div>
                                        <h2>Order #{{ $order->id }}</h2>
                                        <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <span class="order-status-badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="order-card-body">
                                    <p><strong>Recipient:</strong> {{ $order->fullname }}</p>
                                    <p><strong>Items:</strong> {{ $itemsCount }} book(s)</p>
                                    <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>

                                <div class="order-card-footer">
                                    <a href="{{ route('users.orders.show', $order->id) }}" class="view-btn">
                                        View Details
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif

            </section>
        </main>
    </div>
</main>
@endsection
