<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bookstore</title>
    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
</head>

<body>

<section class="auth-section">
    <div class="auth-container">

        <h2>Login</h2>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM LOGIN ASLI UNTUK LARAVEL --}}
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email atau Username</label>
                <input
                    type="text"
                    name="login"
                    placeholder="Masukkan email atau username"
                    value="{{ old('login') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Login</button>
        </form>

        <div class="auth-footer">
            <p>Belum punya akun?
                <a href="{{ url('/register') }}">Daftar sekarang</a>
            </p>
        </div>

    </div>
</section>

</body>
</html>
