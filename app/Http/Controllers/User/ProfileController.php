<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail(Auth::id());

        return view('users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:500',
            'city'        => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $user = User::findOrFail(Auth::id());

        $user->update([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()
            ->route('users.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
