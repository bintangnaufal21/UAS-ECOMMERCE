<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register'); // pastikan ini file register.blade.php kamu
    }

    // Proses register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'username'              => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'                 => ['nullable', 'string', 'max:20'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],
            // field password_confirmation otomatis dicek oleh rule "confirmed"
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => 'user',      // semua yang register dari sini jadi user biasa
        ]);

        // langsung login setelah register
        Auth::login($user);

        // user biasa diarahkan ke dashboard user
        return redirect()->route('users.dashboard');
    }
}
