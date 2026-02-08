<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Tampilkan daftar staff.
     */
    public function index()
    {
        $staffs = User::orderBy('name')->paginate(10);
        return view('staff.index', compact('staffs'));
    }

    /**
     * Tampilkan form tambah staff.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Simpan staff baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff,student',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    /**
     * Edit data staff.
     */
    public function edit(User $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update staff.
     */
    public function update(Request $request, User $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'role' => 'required|in:admin,staff,student',
            'password' => 'nullable|string|min:6', // tambahkan validasi password opsional
        ]);

        // Data dasar
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika ada password baru, tambahkan ke data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update data
        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil diperbarui.');
    }


    /**
     * Hapus staff.
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }
}
