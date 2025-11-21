@extends('layouts.layoutUser')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
@endsection

@section('content')

<style>
    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    .banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        padding: 1.5rem 2rem;
        margin: 1.5rem auto 2rem;
        background: #ffe4f1;
        border-radius: 16px;
    }

    .banner-content h2 {
        font-size: 1.8rem;
        margin-bottom: .5rem;
    }

    .banner-content p {
        margin-bottom: 1rem;
    }

    .banner-image {
        flex-shrink: 0;
    }

    .banner-image img {
        max-width: 380px;
        max-height: 300px;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }

    .book-item { position: relative; }

    .bestselling-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 20px;
      padding: 20px 0;
    }

    .book-img img { width: 100%; height: auto; border-radius: 8px; }
    .price { font-weight: 600; margin-top: 4px; }
    .section-header { margin-top: 20px; }
    .section-header h2 { margin-bottom: 4px; }

    .cart-btn {
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

    .cart-btn:hover {
        background: #4f46e5;
    }

    @media (max-width: 768px) {
        .banner {
            flex-direction: column;
            text-align: center;
        }

        .banner-image img {
            max-width: 100%;
            max-height: 220px;
        }
    }
</style>

<main class="content-wrapper">

    {{-- BANNER --}}
    <section class="banner">
      <div class="banner-content">
        <h2>{{ $bannerTitle }}</h2>
        <p>{{ $bannerDesc }}</p>
        <a href="#books"><button class="shop-now-btn" type="button">BELI SEKARANG</button></a>
      </div>

      @if ($bannerImage)
        <div class="banner-image">
            <img src="{{ asset('storage/' . $bannerImage) }}" alt="Banner" style="max-width:100%; border-radius:12px;">
        </div>
      @endif
    </section>

    {{-- ===================== BEST SELLER ===================== --}}
    @if ($bestsellers->count())
    <section class="bestselling-books" id="bestseller">
      <div class="section-header">
        <h2>Best Seller</h2>
      </div>

      <div class="bestselling-grid">
        @foreach ($bestsellers as $book)
        <div class="book-item">
            <div class="book-img">
                <a href="{{ route('users.books.show', $book->id) }}">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                    @else
                        <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" alt="{{ $book->title }}">
                    @endif
                </a>
            </div>

            <h3>
                <a href="{{ route('users.books.show', $book->id) }}" style="text-decoration:none; color:inherit;">
                    {{ $book->title }}
                </a>
            </h3>
            <p class="author">Kategori: {{ $book->category->name ?? '-' }}</p>
            <p class="price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

            {{-- Tambah ke keranjang --}}
            <form action="{{ route('users.cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="cart-btn">Tambah ke Keranjang</button>
            </form>
        </div>
        @endforeach
      </div>
    </section>
    @endif

    {{-- ===================== SEMUA BUKU ===================== --}}
    <section class="bestselling-books" id="books">
      <div class="section-header">
        <h2>Semua Buku</h2>
      </div>

      <div class="bestselling-grid">
        @forelse ($books as $book)
        <div class="book-item">
            <div class="book-img">
                <a href="{{ route('users.books.show', $book->id) }}">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                    @else
                        <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" alt="{{ $book->title }}">
                    @endif
                </a>
            </div>

            <h3>
                <a href="{{ route('users.books.show', $book->id) }}" style="text-decoration:none; color:inherit;">
                    {{ $book->title }}
                </a>
            </h3>
            <p class="author">Kategori: {{ $book->category->name ?? '-' }}</p>
            <p class="price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

            {{-- Tambah ke keranjang --}}
            <form action="{{ route('users.cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="cart-btn">Tambah ke Keranjang</button>
            </form>
        </div>
        @empty
            <p style="grid-column: 1 / -1; text-align:center;">Belum ada buku tersedia.</p>
        @endforelse
      </div>
    </section>

</main>

@endsection
