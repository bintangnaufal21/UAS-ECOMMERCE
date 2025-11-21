@extends('layouts.layoutAdmin')

@section('title', 'Tambah Kategori')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/bookm.css') }}">
@endsection

@section('content')

<header class="navbar">
    <div class="navbar-content">
        <h1>Category Management</h1>
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
        <h2>Tambah Kategori</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
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
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.categories.index') }}" class="btn cancel-btn">Batal</a>
                <button class="btn submit-btn">Simpan</button>
            </div>
        </form>
    </div>

</main>

@endsection
