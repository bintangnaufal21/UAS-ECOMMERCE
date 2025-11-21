<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // sesuaikan dengan nama view kamu
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan apakah user login dengan email atau username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username'; // username

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role untuk redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('users.dashboard');
        }

        return back()->withErrors([
            'login' => 'Email/username atau password salah.',
        ]);
    }



    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
