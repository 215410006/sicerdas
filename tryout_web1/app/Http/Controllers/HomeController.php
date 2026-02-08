<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tryout;
use App\Models\TryoutResult;
use App\Models\TryoutAnswer;
use App\Models\Materi;
use App\Models\Question;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard_admin');
        } elseif (Auth::user()->role === 'staff') {
            return redirect()->route('staff.dashboard_staff');
        } elseif (Auth::user()->role === 'student') {
            return redirect()->route('students.dashboard_student');
        }

        return redirect('/');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard_admin', [
            'totalSoal' => Question::count(),
            'totalMateri' => Materi::count(),
            'totalPengguna' => User::count(),
            'chartLabels' => Tryout::pluck('nama_tryout'),
            'chartData' => TryoutResult::selectRaw('tryout_id, AVG(score) as avg_score')
                ->groupBy('tryout_id')
                ->pluck('avg_score'),
            'leaderboard' => TryoutResult::with('student')
                ->selectRaw('student_id, MAX(score) as max_score')
                ->groupBy('student_id')
                ->orderByDesc('max_score')
                ->take(3)
                ->get()
        ]);
    }

    public function staffDashboard()
    {
        return view('staff.dashboard_staff', [
            'totalSoal' => Question::count(),
            'totalMateri' => Materi::count(),
            'totalTryout' => Tryout::count(),
            'latestQuestions' => Question::latest()->take(3)->get(),
            'latestMateri' => Materi::latest()->take(3)->get(),
        ]);
    }
    public function studentDashboard()
    {
        $user = auth()->user();

        // Ambil jumlah tryout yang tersedia
        $availableTryouts = Tryout::where('status', 'publish')->latest()->take(3)->get();
        // Hitung jumlah tryout yang telah dikerjakan oleh siswa ini
        $doneTryouts = TryoutResult::where('student_id', $user->id)->distinct('tryout_id')->count('tryout_id');

        // Hitung rata-rata skor siswa
        $averageScore = TryoutResult::where('student_id', $user->id)->avg('score') ?? 0;

        // Materi terbaru, ambil 3
        $latestMaterials = Materi::orderBy('created_at', 'desc')->limit(3)->get();

        // Hasil tryout terakhir siswa
        $latestResult = TryoutResult::where('student_id', $user->id)->latest()->first();

        $studentId = auth()->id();

        $lastTryout = TryoutResult::where('student_id', $studentId)
                        ->latest('created_at')
                        ->first();

        // Kirim ke view
        return view('students.dashboard_student', [
            'availableTryouts' => $availableTryouts,
            'doneTryouts' => $doneTryouts,
            'averageScore' => round($averageScore, 2),
            'latestMaterials' => $latestMaterials,
            'latestResult' => $latestResult,
            'lastTryout' => $lastTryout,
        ]);
    }
}
