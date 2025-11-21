@extends('layouts.layoutUser')

@section('title', $book->title)

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
@endsection

@section('content')

    <style>
        .product-wrapper {
            max-width: 1100px;
            margin: 20px auto 40px;
            padding: 20px;
        }

        .product-card {
            display: grid;
            grid-template-columns: minmax(0, 320px) minmax(0, 1fr);
            gap: 24px;
            padding: 24px;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
        }

        .product-image img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
        }

        .product-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .product-category {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .product-stock {
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        .product-description {
            margin-top: 12px;
            line-height: 1.6;
        }

        .product-actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            padding: 10px 18px;
            border-radius: 999px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            background: #6366f1;
            color: #fff;
        }

        .btn-secondary {
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            font-weight: 500;
            cursor: pointer;
            background: #fff;
            color: #374151;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .product-card {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="product-wrapper">
        <a href="{{ url()->previous() }}" class="btn-secondary" style="margin-bottom: 16px; display:inline-block;">
            ← Kembali
        </a>

        <div class="product-card">
            <div class="product-image">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                @else
                    <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" alt="{{ $book->title }}">
                @endif
            </div>

            <div>
                <h1 class="product-title">{{ $book->title }}</h1>

                <div class="product-category">
                    Kategori: {{ $book->category->name ?? '-' }}
                </div>

                <div class="product-price">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </div>

                <div class="product-stock">
                    Stok: {{ $book->stock }}
                </div>

                <div class="product-description">
                    {!! nl2br(e($book->description)) !!}
                </div>

                <div class="product-actions" style="margin-top:18px;">
                    <form action="{{ route('users.cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn-primary">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
