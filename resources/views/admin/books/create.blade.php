@extends('layouts.layoutAdmin')

@section('title', 'Tambah Buku')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/bookm.css') }}">
@endsection

@section('content')

<header class="navbar">
    <div class="navbar-content">
        <h1>Book Management</h1>
        <div class="user-info">
            <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</header>

<main class="main-content">

    <div class="header-section">
        <h2>Tambah Buku Baru</h2>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 1rem;">
            <ul style="margin-left: 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Upload Gambar Buku</label>
                <input type="file" id="image" name="image" accept="image/*">
                <p class="form-note">Pilih file gambar (opsional).</p>
            </div>

            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Singkat</label>
                <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.books.index') }}" class="btn cancel-btn">Batal</a>
                <button type="submit" class="btn submit-btn">Simpan</button>
            </div>
        </form>
    </div>

</main>

@endsection

@section('scripts')
@endsection
