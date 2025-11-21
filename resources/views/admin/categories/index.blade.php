@extends('layouts.layoutAdmin')

@section('title', 'Category Management')

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
            <h2>Daftar Kategori</h2>
            <a href="{{ route('admin.categories.create') }}" class="add-btn">Tambah Kategori</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table id="categories-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn-action btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

@endsection
