<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Tampilkan semua materi (untuk siswa).
     */
    public function index()
    {
        $materis = Materi::with('kategori')
            ->select('id', 'judul', 'kategori_id', 'file_path') // optimalkan
            ->latest()
            ->paginate(10);

        // Tambahkan file URL
        $materis->getCollection()->transform(function ($materi) {
            $materi->file_url = $materi->file_path 
                ? asset('storage/' . $materi->file_path)
                : null;
            return $materi;
        });

        return response()->json($materis);
    }

    /**
     * Tampilkan detail 1 materi.
     */
    public function show($id)
    {
        $materi = Materi::with('kategori')->findOrFail($id);

        $materi->file_url = $materi->file_path 
            ? asset('storage/' . $materi->file_path)
            : null;

        return response()->json($materi);
    }
}
