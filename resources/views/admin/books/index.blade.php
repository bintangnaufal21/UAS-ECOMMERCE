@extends('layouts.layoutAdmin')

@section('title', 'Book Management')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/bookm.css') }}">
@endsection

@section('content')

    <!-- Navbar -->
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

    <!-- Main Content -->
    <main class="main-content">

        <div class="header-section">
            <h2>Book List</h2>
            <a href="{{ route('admin.books.create') }}" class="add-btn">Tambah Buku Baru</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table id="books-table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="books-tbody">
                    @forelse ($books as $book)
                        <tr>
                            <td>
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                        style="width:60px; height:auto;">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category->name ?? '-' }}</td>
                            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn-action btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
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
                            <td colspan="6" style="text-align: center;">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

@endsection

@section('scripts')
@endsection
