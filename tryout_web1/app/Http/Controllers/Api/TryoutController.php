<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutResult;
use Illuminate\Support\Facades\Auth;

class TryoutController extends Controller
{
    /**
     * List semua tryout yang tersedia.
     */
    public function index()
    {
        $tryouts = Tryout::where('status', 'publish')
            ->withCount('questions')
            ->latest()
            ->paginate(10);

        return response()->json($tryouts);
    }

    /**
     * Jadwal tryout (filter berdasarkan tanggal jika diberikan).
     */
    public function schedule(Request $request)
    {
        $query = Tryout::where('status', 'publish');

        if ($request->filled('tanggal')) {
            $date = \Carbon\Carbon::parse($request->tanggal);
            $query->whereDate('tanggal_mulai', '<=', $date)
                  ->whereDate('tanggal_selesai', '>=', $date);
        }

        $jadwal = $query->orderBy('tanggal_mulai')->get();

        return response()->json($jadwal);
    }

    /**
     * Hasil tryout siswa yang sedang login.
     */
    public function result(Request $request)
    {
        $user = $request->user();

        $results = TryoutResult::with('tryout')
            ->where('student_id', $user->id)
            ->latest()
            ->get();

        return response()->json($results);
    }

    public function history(Request $request)
    {
        $user = $request->user();
    
        $results = TryoutResult::with('tryout.questions')
            ->where('student_id', $user->id)
            ->latest()
            ->get();
    
        // Format responsenya
        $formatted = $results->map(function ($res) {
            return [
                'score' => $res->score,
                'nama_tryout' => $res->tryout->nama_tryout ?? 'Tidak Diketahui',
                'tanggal_mulai' => $res->tryout->tanggal_mulai ?? null,
                'tanggal_selesai' => $res->tryout->tanggal_selesai ?? null,
                'jumlah_soal' => $res->tryout->questions->count(),
            ];
        });
    
        return response()->json($formatted);
    }
    

    /**
     * Leaderboard berdasarkan skor tertinggi.
     */
    public function leaderboard()
    {
        $leaderboard = TryoutResult::with(['student:id,name', 'tryout:id,nama_tryout'])
            ->whereNotNull('score')
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return response()->json($leaderboard);
    }
}
