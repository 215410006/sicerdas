<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriKategori;

class MateriKategoriController extends Controller
{
    public function index()
    {
        $kategoris = MateriKategori::all();
        return view('materi_kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('materi_kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:materi_kategoris,nama',
        ]);

        MateriKategori::create(['nama' => $request->nama]);

        return redirect()->route('materi_kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(MateriKategori $kategori)
    {
        return view('materi_kategori.edit', compact('kategori'));
    }

    public function update(Request $request, MateriKategori $kategori)
    {
        $request->validate([
            'nama' => 'required|unique:materi_kategoris,nama,' . $kategori->id,
        ]);

        $kategori->update(['nama' => $request->nama]);

        return redirect()->route('materi_kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(MateriKategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('materi_kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
