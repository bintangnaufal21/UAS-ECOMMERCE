@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
@endsection

@section('content')

<style>
    .category-wrapper {
        max-width: 1100px;
        margin: 20px auto 40px;
        padding: 0 16px;
    }

    .category-header {
        margin-bottom: 16px;
    }

    .category-header h2 {
        margin-bottom: 4px;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
    }

    .book-card {
        border-radius: 12px;
        padding: 12px;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    }

    .book-card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 6px;
    }

    .book-card h3 {
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .book-card .price {
        font-weight: 600;
        margin-top: 4px;
    }

    .btn-cart {
        margin-top: 6px;
        border: none;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        background: #6366f1;
        color: #ffffff;
    }

    .btn-cart:hover {
        background: #4f46e5;
    }
</style>

<div class="category-wrapper">
    <div class="category-header">
        <h2>{{ $category->name }}</h2>
        @if ($category->description)
            <p>{{ $category->description }}</p>
        @endif
    </div>

    <div class="books-grid">
        @forelse ($books as $book)
            <div class="book-card">
                <a href="{{ route('users.books.show', $book->id) }}">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                    @else
                        <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" alt="{{ $book->title }}">
                    @endif
                </a>

                <h3>
                    <a href="{{ route('users.books.show', $book->id) }}" style="text-decoration:none; color:inherit;">
                        {{ $book->title }}
                    </a>
                </h3>

                <p class="price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

                {{-- Tambah ke keranjang --}}
                <form action="{{ route('users.cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn-cart">Tambah ke Keranjang</button>
                </form>
            </div>
        @empty
            <p style="grid-column: 1 / -1;">Belum ada buku untuk kategori ini.</p>
        @endforelse
    </div>
</div>

@endsection
