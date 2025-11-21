@extends('layouts.layoutAdmin')

@section('title', 'Homepage Management - Admin Dashboard')

{{-- CSS khusus halaman homepage --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
@endsection

@section('content')
    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-content">
            <h1>Homepage</h1>
            <div class="user-info">
                <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>

        @if (session('success'))
            <div class="alert alert-success" style="margin: 1rem 0;">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM UTAMA HOMEPAGE (BEST SELLER + BANNER) --}}
        <form action="{{ route('admin.homepages.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- BEST SELLING BOOKS --}}
            <div class="section-container">
                <div class="section-header">
                    <h2>Best Selling Books</h2>
                    <p>Pilih buku yang akan ditampilkan di bagian Best Seller pada homepage user.</p>
                </div>

                <div style="overflow-x: auto;">
                    <table class="books-table">
                        <thead>
                            <tr>
                                <th>Gambar Buku</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Best Seller</th>
                                <th>Urutan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>
                                        @if ($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}" class="book-image" alt="Book Cover">
                                        @else
                                            <img src="{{ asset('proyek1/images/Marc Cubillas.jpeg') }}" class="book-image" alt="Book Cover">
                                        @endif
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->category->name ?? '-' }}</td>
                                    <td style="text-align:center;">
                                        <input
                                            type="checkbox"
                                            name="bestseller_books[]"
                                            value="{{ $book->id }}"
                                            {{ $book->is_bestseller ? 'checked' : '' }}
                                        >
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            name="bestseller_order[{{ $book->id }}]"
                                            value="{{ $book->bestseller_order ?? '' }}"
                                            min="1"
                                            max="50"
                                            style="width: 70px;"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            {{-- BANNER PROMO --}}
            <div class="section-container">
                <div class="section-header">
                    <h2>Banner Promo</h2>
                    <p>Unggah dan atur banner promo untuk homepage user.</p>
                </div>

                <div class="banner-form">

                    <div class="form-group">
                        <label for="banner-file">Upload Banner (Gambar)</label>
                        <input type="file" id="banner-file" name="banner_image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="banner-title">Judul Banner</label>
                        <input
                            type="text"
                            id="banner-title"
                            name="banner_title"
                            value="{{ old('banner_title', $bannerTitle ?? '') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="banner-desc">Deskripsi Singkat Banner</label>
                        <textarea
                            id="banner-desc"
                            name="banner_desc"
                            rows="3"
                        >{{ old('banner_desc', $bannerDesc ?? '') }}</textarea>
                    </div>

                    {{-- PREVIEW --}}
                    <div class="preview-section">
                        <h3>Preview Banner Saat Ini</h3>
                        @if (!empty($bannerImage))
                            <img src="{{ asset('storage/' . $bannerImage) }}" alt="Banner Preview" class="banner-preview">
                        @else
                            <p>Belum ada banner diset.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SAVE BUTTON --}}
            <div class="save-section">
                <button type="submit" class="save-btn">Simpan Perubahan</button>
            </div>

        </form>

    </main>
@endsection
