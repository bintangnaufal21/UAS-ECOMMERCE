@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/co.css') }}">
@endsection

@section('content')

    <div class="checkout-container">
        <header class="checkout-header">
            <h1>Checkout</h1>
            <p>Review pesanan Anda dan lengkapi data pengiriman</p>
        </header>

        <main class="checkout-main">

            {{-- FORM CHECKOUT --}}
            <form action="{{ route('users.cart.processCheckout') }}" method="POST" style="display:contents;">
                @csrf

                {{-- BAGIAN FORM DATA & METODE --}}
                <section class="form-section">
                    {{-- DATA PENGIRIMAN --}}
                    <div class="form-card">
                        <h2>Shipping Information</h2>

                        @if ($errors->any())
                            <div style="color:red; margin-bottom:10px;">
                                <ul style="margin-left: 16px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="input-group">
                            <label for="full-name">Full Name *</label>
                            <input type="text" id="full-name" name="fullname"
                                value="{{ old('fullname', Auth::user()->name) }}" required>
                        </div>

                        <div class="input-group">
                            <label for="address">Full Address *</label>
                            <textarea id="address" name="address" rows="3" required>{{ old('address', Auth::user()->address) }}</textarea>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <input type="text" id="city" name="city"
                                    value="{{ old('city', Auth::user()->city) }}">
                            </div>
                            <div class="input-group">
                                <input type="text" id="postal-code" name="postal_code"
                                    value="{{ old('postal_code', Auth::user()->postal_code) }}">
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone"
                                    value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                            </div>
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email,', Auth::user()->email) }}">
                            </div>
                        </div>
                    </div>

                    {{-- METODE PENGIRIMAN --}}
                    <div class="form-card">
                        <h2>Shipping Method</h2>
                        <div class="shipping-options">
                            <label class="shipping-option">
                                <input type="radio" name="shipping" value="jne" checked>
                                <span class="option-label">JNE</span>
                                <span class="option-details">Standard Delivery - Rp 20.000 (3-5 hari)</span>
                            </label>
                            <label class="shipping-option">
                                <input type="radio" name="shipping" value="sicepat">
                                <span class="option-label">SiCepat</span>
                                <span class="option-details">Express Delivery - Rp 25.000 (2-4 hari)</span>
                            </label>
                            <label class="shipping-option">
                                <input type="radio" name="shipping" value="jt">
                                <span class="option-label">J&T</span>
                                <span class="option-details">Fast Delivery - Rp 22.000 (2-3 hari)</span>
                            </label>
                            <label class="shipping-option">
                                <input type="radio" name="shipping" value="pos">
                                <span class="option-label">Pos Indonesia</span>
                                <span class="option-details">Economy Delivery - Rp 15.000 (5-7 hari)</span>
                            </label>
                        </div>
                    </div>

                    {{-- METODE PEMBAYARAN --}}
                    <div class="form-card">
                        <h2>Payment Method</h2>
                        <div class="payment-options">
                            <label class="payment-option">
                                <input type="radio" name="payment" value="bank" checked>
                                <span class="option-icon">🏦</span>
                                <span class="option-label">Bank Transfer</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="wallet">
                                <span class="option-icon">💳</span>
                                <span class="option-label">E-Wallet (GoPay, OVO, dll.)</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="card">
                                <span class="option-icon">💳</span>
                                <span class="option-label">Credit Card</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="cod">
                                <span class="option-icon">💰</span>
                                <span class="option-label">Cash on Delivery (COD)</span>
                            </label>
                        </div>
                    </div>
                </section>

                {{-- BAGIAN RINGKASAN PESANAN --}}
                <aside class="summary-section">
                    <div class="summary-card">
                        <h2>Order Summary</h2>

                        <div class="order-items" id="order-items">
                            @foreach ($cart as $item)
                                <div class="order-item">
                                    <div class="item-info">
                                        <div class="item-title">{{ $item['title'] }}</div>
                                        <div class="item-qty">Qty: {{ $item['qty'] }}</div>
                                    </div>
                                    <div class="item-price">
                                        Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="summary-totals">
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            {{-- Untuk sekarang, biaya ongkir hanya informasi, belum dihitung otomatis --}}
                            <div class="total-row">
                                <span>Shipping:</span>
                            </div>

                            <div class="total-row grand-total">
                                <span>Grand Total (Barang):</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="place-order-btn">Place Order</button>
                    </div>
                </aside>
            </form>
        </main>
    </div>

@endsection
