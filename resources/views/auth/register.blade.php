<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bookstore</title>

    <link rel="stylesheet" href="{{ asset('proyek1/css/style.css') }}">
</head>

<body>

    <section class="auth-section">
        <div class="auth-container">

            <h2>Register</h2>

            {{-- TAMPILKAN ERROR VALIDASI --}}
            @if ($errors->any())
                <div style="color:red; margin-bottom:10px;">
                    <ul style="margin-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM REGISTER LARAVEL --}}
            <form action="{{ route('register.process') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor HP</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                        placeholder="Masukkan nomor HP">
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Masukkan ulang kata sandi" required>
                </div>

                <button type="submit" class="auth-btn">
                    Daftar
                </button>

            </form>

            <div class="auth-footer">
                <p>Sudah punya akun?
                    <a href="{{ url('/login') }}">Masuk</a>
                </p>
            </div>

        </div>
    </section>

</body>

</html>
