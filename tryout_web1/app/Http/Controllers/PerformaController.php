<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TryoutResult;
use App\Models\Tryout;
use App\Models\User;


class PerformaController extends Controller
{
    // Laporan Skor
    public function laporanSkor()
    {
        $laporanSkor = TryoutResult::with(['student', 'tryout'])
        ->whereNotNull('score')
        ->orderByDesc('created_at')
        ->paginate(10);
    
        $tryouts = Tryout::all(); // tambahkan baris ini
    
        return view('performa.laporan_skor', compact('laporanSkor', 'tryouts'));
    }

    // Kemajuan Siswa
    public function kemajuanSiswa(Request $request)
    {
        $students = User::all(); // ambil semua siswa untuk dropdown
        $studentId = $request->input('student_id', auth()->id());

        $hasil = TryoutResult::with('tryout')
            ->where('student_id', $studentId)
            ->orderBy('created_at')
            ->get();

        $labels = $hasil->pluck('tryout.nama_tryout');
        $data = $hasil->pluck('score');

        $averageScore = $hasil->avg('score') ?? 0;
        $highestScore = $hasil->max('score') ?? 0;
        $lowestScore = $hasil->min('score') ?? 0;

        return view('performa.kemajuan', compact(
            'students', 'labels', 'data', 'averageScore', 'highestScore', 'lowestScore'
        ));
    }


    // Kehadiran
    public function kehadiran()
    {
        $kehadiran = TryoutResult::with(['student', 'tryout'])
            ->orderByDesc('created_at')
            ->get();

        return view('performa.kehadiran', compact('kehadiran'));
    }
}
