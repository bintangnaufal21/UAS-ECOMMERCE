@extends('layouts.layoutUser')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
@endsection

@section('content')

<section class="categories-hero">
    <div class="categories-overlay">
      <h2>Kategori Buku</h2>

      <div class="categories-grid">
        @forelse ($categories as $category)
            <div class="category-box">
              <a href="{{ route('users.category.show', $category->id) }}">
                {{ $category->name }}
              </a>
              @if ($category->description)
                  <p style="margin-top:4px; font-size:0.85rem;">{{ $category->description }}</p>
              @endif
            </div>
        @empty
            <p>Belum ada kategori.</p>
        @endforelse
      </div>
    </div>
</section>

@endsection
