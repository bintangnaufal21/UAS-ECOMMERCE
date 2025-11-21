@extends('layouts.layoutUser')

@section('title', 'Profile')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/profile.css') }}">
@endsection

@section('content')

<style>
    .profile-wrapper {
        max-width: 800px;
        margin: 20px auto 40px;
        padding: 0 16px;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    }

    .profile-card h2 {
        margin-bottom: 8px;
    }

    .profile-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
        margin-bottom: 14px;
    }

    .alert-success {
        background:#dcfce7;
        border:1px solid #22c55e;
        color:#166534;
        padding:8px 10px;
        border-radius:8px;
        margin-bottom:10px;
        font-size:0.9rem;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display:block;
        font-weight:500;
        margin-bottom:4px;
    }

    .form-group input,
    .form-group textarea {
        width:100%;
        border-radius:8px;
        border:1px solid #d1d5db;
        padding:8px 10px;
        font-size:0.95rem;
    }

    .form-row {
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .save-btn {
        margin-top: 10px;
        padding: 8px 18px;
        border-radius:999px;
        border:none;
        background:#22c55e;
        color:#fff;
        font-weight:600;
        cursor:pointer;
        font-size:0.95rem;
    }

    .save-btn:hover {
        background:#16a34a;
    }

    .profile-info-static {
        margin-bottom: 14px;
        border-bottom:1px solid #e5e7eb;
        padding-bottom:10px;
    }

    .profile-info-static p {
        margin:0;
        font-size:0.95rem;
    }

    .profile-info-static p + p {
        margin-top:2px;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">
        <h2>Profil Saya</h2>
        <p class="profile-subtitle">
            Atur informasi akun dan alamat default yang akan digunakan saat checkout.
        </p>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Info user dasar --}}
        <div class="profile-info-static">
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        {{-- Form update profile + alamat default --}}
        <form action="{{ route('users.profile.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required>
                @error('name')
                    <div style="color:#b91c1c; font-size:0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div style="color:#b91c1c; font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="postal_code">Kode Pos</label>
                    <input type="text"
                           id="postal_code"
                           name="postal_code"
                           value="{{ old('postal_code', $user->postal_code) }}">
                    @error('postal_code')
                        <div style="color:#b91c1c; font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address">Alamat Lengkap</label>
                <textarea id="address"
                          name="address"
                          rows="3">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <div style="color:#b91c1c; font-size:0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">Kota / Kabupaten</label>
                <input type="text"
                       id="city"
                       name="city"
                       value="{{ old('city', $user->city) }}">
                @error('city')
                    <div style="color:#b91c1c; font-size:0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="save-btn">
                Simpan Profil
            </button>
        </form>
    </div>
</div>

@endsection
