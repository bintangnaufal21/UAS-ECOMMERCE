@extends('layouts.layoutGuest')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
@endsection
@section('content')

    <style>
        /* Tambahan untuk ikon keranjang */
        .book-item {
            position: relative;
        }

        .cart-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .cart-icon:hover {
            background: #c84b6f;
        }

        .bestselling-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .book-img img {
            width: 100%;
            height: auto;
        }

        .search-logout .logout-btn {
            margin-left: 20px;
            color: #fff;
            background: #c84b6f;
            border: none;
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .search-logout .logout-btn:hover {
            background: #4caf50;
        }

        /* Profil dropdown */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .profile-dropdown-content a {
            color: black;
            padding: 8px 12px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown-content a:hover {
            background-color: #c84b6f;
        }

        /* Dropdown Logout */
        .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            /* kasih jarak dari tombol inisial */
            background-color: #c84b6f;
            min-width: 140px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            /* kotaknya agak bulat */
            overflow: hidden;
            z-index: 1;
        }

        /* Gaya tombol Logout di dalam dropdown */
        .profile-dropdown-content a {
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
            border-radius: 8px;
            /* tombol juga sedikit bulat */
            transition: background 0.3s;
        }

        .profile-dropdown-content a:hover {
            background-color: #a83758;
            /* sedikit lebih gelap saat hover */
        }

        /* Tampilkan dropdown saat dihover */
        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }
    </style>

    <main class="content-wrapper">
        <section class="banner">
            <div class="banner-content">
                <h2>Free shipping on all orders over $49*</h2>
                <p>Limited time only</p>
                <button class="shop-now-btn">SHOP NOW</button>
            </div>
        </section>

        @if ($book->count())
        <section class="bestselling-books">
            <div class="section-header">
                <h2>Bestselling Books</h2>
            </div>

            <div class="bestselling-grid">
                @foreach ($book as $book)
                    <div class="book-item">
                        <div class="book-img">
                            @if ($book->image)
                             <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                            @else
                                <h6>Gambar {{$book->title}}</h6>
                            @endif
                        </div>
                        <h3>{{ $book->title }}</h3>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </main>
@endsection
