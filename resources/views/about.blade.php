@extends('layouts.layoutGuest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('proyek1/css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('proyek1/css/header.css') }}">
@endsection

@section('content')
     <main class="content-wrapper"> <!-- Bagian utama isi halaman -->
    <section class="about-section"> <!-- Bagian khusus tentang "About" -->
      <div class="about-container"> <!-- Container isi About -->
        <h2>About Booktopia</h2> <!-- Judul bagian About -->
        <p>
          Welcome to <strong>Booktopia</strong> —  <!-- Teks deskripsi toko -->
        </p>

        <div class="about-grid"> <!-- Grid untuk 3 kotak info -->
          <div class="about-card"> <!-- Kotak 1: Misi -->
            <h3>📚 Our Mission</h3>
            <p>To make reading accessible to everyone...</p>
          </div>

          <div class="about-card"> <!-- Kotak 2: Visi -->
            <h3>💡 Our Vision</h3>
            <p>To be the most trusted and loved online bookstore...</p>
          </div>

          <div class="about-card"> <!-- Kotak 3: Tim -->
            <h3>👥 Our Team</h3>
            <p>Our dedicated team of book enthusiasts...</p>
          </div>
        </div>

        <div class="about-footer"> <!-- Bagian bawah, info kontak -->
          <h3>Contact Us</h3> <!-- Judul kontak -->
          <p>Email: support@booktopia.com.au</p> <!-- Email kontak -->
          <p>Phone: +61 2 9999 9999</p> <!-- Nomor telepon -->
          <p>Address: 123 Sydney Road, NSW 2000, Australia</p> <!-- Alamat kantor -->
        </div>
      </div>
    </section>
  </main>
@endsection
