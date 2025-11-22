@extends('layouts.layoutUser')

@section('title', 'Search Results')

@section('styles')
    {{-- sama seperti halaman dashboard user --}}
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
@endsection

@section('content')

<style>
    .content-wrapper {
        max-width: 1200px;
        margin: 20px auto 40px;
        padding: 0 16px;
    }

    .section-header {
        margin-bottom: 10px;
    }

    .section-header h2 {
        font-size: 1.6rem;
        margin-bottom: 4px;
    }

    .section-header p {
        margin: 0;
        color: #6b7280;
    }

    .bestselling-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
        padding: 20px 0;
    }

    .book-item { position: relative; }

    .book-img img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    .book-item h3 {
        margin-top: 8px;
        margin-bottom: 2px;
        font-size: 1rem;
    }

    .author {
        margin: 0;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .price {
        font-weight: 600;
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 0 12px;
        }
    }
</style>

<main class="content-wrapper">
    <section class="bestselling-books">
        <div class="section-header">
            <h2>Search results for: {{ $query }}</h2>
            <p>
                @if($books->count())
                    Ditemukan {{ $books->count() }} buku.
                @else
                    Tidak ada buku yang cocok dengan pencarian.
                @endif
            </p>
        </div>

        @if ($books->isEmpty())
            <p style="margin-top:20px;">
                Coba gunakan kata kunci lain, atau
                <a href="{{ route('users.dashboard') }}">kembali ke halaman utama</a>.
            </p>
        @else
            <div class="bestselling-grid">
                @foreach ($books as $book)
                    <div class="book-item">
                        <div class="book-img">
                            @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                            @else
                                <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" alt="{{ $book->title }}">
                            @endif
                        </div>

                        <h3>{{ $book->title }}</h3>
                        <p class="author">
                            Kategori: {{ $book->category->name ?? '-' }}
                        </p>
                        <p class="price">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</main>
@endsection
