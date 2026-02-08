<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MateriKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::with('kategori')->paginate(10); // Gunakan paginate, bukan get()

        return view('materi.index', compact('materis'));
    }

    public function create()
    {
        $kategoris = MateriKategori::all();
        return view('materi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
            'kategori_id' => 'required|exists:materi_kategoris,id',
        ]);

        $materi = new Materi();
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->kategori_id = $request->kategori_id;
        $materi->user_id = auth()->id();

        if ($request->hasFile('file')) {
            $materi->file_path = $request->file('file')->store('materi', 'public');
        }

        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        $kategoris = MateriKategori::all();
        return view('materi.edit', compact('materi', 'kategoris'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
            'kategori_id' => 'required|exists:materi_kategoris,id',
        ]);

        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->kategori_id = $request->kategori_id;

        if ($request->hasFile('file')) {
            Storage::delete('public/' . $materi->file_path);
            $materi->file_path = $request->file('file')->store('materi', 'public');
        }

        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        Storage::delete('public/' . $materi->file_path);
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    public function show(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }
}
