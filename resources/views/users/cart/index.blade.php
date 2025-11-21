@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/cart.css') }}">
@endsection

@section('content')

    <style>
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 16px 40px;
        }

        .cart-main {
            margin-top: 16px;
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1.1fr);
            gap: 24px;
            align-items: flex-start;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 500px;
            overflow-y: auto;
        }

        .cart-item {
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            gap: 14px;
            padding: 12px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .item-image img {
            width: 110px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        .item-details h2 {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .item-details p {
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .quantity-control input[type="number"] {
            width: 60px;
            padding: 4px 6px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            text-align: center;
        }

        .item-subtotal {
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            white-space: nowrap;
        }

        .remove-btn {
            margin-top: 12px;
            padding: 8px 16px;
            border-radius: 999px;
            border: none;
            background: #ef4444;
            color: #fff;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .update-btn {
            margin-top: 12px;
            padding: 8px 16px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #fff;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }

        .cart-summary-section {
            position: static;
        }

        .cart-summary {
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
            padding: 20px 22px;
        }

        .summary-row span:last-child {
            white-space: nowrap;
        }

        @media (max-width: 900px) {
            .cart-main {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <main class="content-wrapper">
        <div class="cart-container">

            <!-- Cart Header -->
            <header class="cart-header">
                <h1>Shopping Cart</h1>
                <a href="{{ route('users.dashboard') }}" class="back-link">← Continue Shopping</a>
            </header>

            @if (session('success'))
                <p style="color:green; margin-top:10px;">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p style="color:red; margin-top:10px;">{{ session('error') }}</p>
            @endif

            @if (empty($cart))
                <p style="margin-top:20px;">Your cart is empty.</p>
            @else
                <!-- Cart Main -->
                <section class="cart-main">

                    <!-- Cart Items Section -->
                    <section class="cart-items-section">

                        {{-- SATU FORM SAJA UNTUK UPDATE & REMOVE --}}
                        <form action="{{ route('users.cart.update') }}" method="POST">
                            @csrf

                            <div class="cart-items">
                                @foreach ($cart as $bookId => $item)
                                    <div class="cart-item">
                                        <div class="item-image">
                                            @if ($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                    alt="{{ $item['title'] }}">
                                            @else
                                                <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}"
                                                    alt="{{ $item['title'] }}">
                                            @endif
                                        </div>

                                        <div class="item-details">
                                            <h2>{{ $item['title'] }}</h2>
                                            <p>Price: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                                            <div class="quantity-control">
                                                <label>Qty:</label>
                                                <input type="number" name="qty[{{ $bookId }}]"
                                                    value="{{ $item['qty'] }}" min="1">
                                            </div>

                                            {{-- tombol hapus: tetap dalam form yang sama, tapi kirim ke route remove --}}
                                            <button type="submit" class="remove-btn"
                                                formaction="{{ route('users.cart.remove') }}" formmethod="POST"
                                                name="book_id" value="{{ $bookId }}">
                                                Remove
                                            </button>
                                        </div>

                                        <div class="item-subtotal">
                                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="update-btn">Update Cart</button>
                        </form>
                    </section>

                    <!-- Cart Summary Section -->
                    <aside class="cart-summary-section">
                        <div class="cart-summary">
                            <h2>Order Summary</h2>
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('users.cart.checkout') }}" class="checkout-btn">Checkout</a>
                        </div>
                    </aside>
                </section>
            @endif
        </div>
    </main>

@endsection
