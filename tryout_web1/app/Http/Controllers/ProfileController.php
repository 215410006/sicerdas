<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */

    public function show()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
        return view('profile.show', compact('user')); // Kirimkan data user ke view
    }

    public function edit(User $user)
    {
        $user = Auth::user();  // Ambil data pengguna yang sedang login
        return view('profile.edit', compact('user'));   
    }

    /**
     * Memperbarui data profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Update data user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

}
