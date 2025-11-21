<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- CSS global admin (umum di semua halaman admin) --}}
    {{-- <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}"> --}}

    {{-- CSS tambahan per halaman --}}
    @yield('styles')
</head>
<body>
    {{-- Sidebar --}}
    @include('components.sidebarAdmin')

    {{-- Main Content --}}
    <div class="main-container">
        @yield('content')
    </div>

    {{-- JS tambahan --}}
    @yield('scripts')
     <script>
        document.addEventListener("DOMContentLoaded", () => {
            const logoutBtn = document.querySelector(".logout-btn");

            if (logoutBtn) {
                logoutBtn.addEventListener("click", () => {
                    // Hapus semua data login dari localStorage
                    localStorage.removeItem("loggedInUser");
                    localStorage.removeItem("isAdmin");

                    // Notifikasi
                    alert("Anda telah logout.");

                    // Arahkan kembali ke halaman login
                    window.location.href = "{{ route('login') }}";
                });
            }
        });
    </script>
</body>
</html>
