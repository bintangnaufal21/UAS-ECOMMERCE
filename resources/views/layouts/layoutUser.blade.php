<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Panel')</title>

    {{-- CSS global user --}}
    {{-- <link rel="stylesheet" href="{{ asset('user/css/style.css') }}"> --}}

    {{-- CSS tambahan per halaman --}}
    @yield('styles')
</head>


<body>

    {{-- Header User --}}
    @include('components.headerUser')

    {{-- Navbar User --}}
    @include('components.NavbarUser')

    {{-- Konten Utama --}}
    <main class="main-container">
        @yield('content')
    </main>

@include('components.footerUser')

    {{-- Script tambahan --}}
    @yield('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const logoutBtn = document.querySelector(".logout-btn");

            if (logoutBtn) {
                logoutBtn.addEventListener("click", () => {
                    // Bersihkan localStorage login user
                    localStorage.removeItem("loggedInUser");

                    alert("Anda telah logout.");
                    window.location.href = "{{ route('login') }}";
                });
            }
        });
    </script>

</body>
</html>
