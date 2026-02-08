<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Tampilkan daftar siswa.
     */
    public function index()
    {
        $students = Student::orderBy('name')->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Simpan siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit siswa.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update data siswa.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Hapus siswa.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
