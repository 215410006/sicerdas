<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutResult;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Data sebelumnya...
        $availableTryouts = Tryout::where('status', 'publish')->latest()->take(3)->get();
        $doneTryouts = TryoutResult::where('student_id', $user->id)->distinct('tryout_id')->count('tryout_id');
        $averageScore = TryoutResult::where('student_id', $user->id)->avg('score') ?? 0;
        $latestMaterials = Materi::orderBy('created_at', 'desc')->limit(3)->get();
        $latestResult = TryoutResult::where('student_id', $user->id)->latest()->first();

        // Peringkat user
        $ranking = TryoutResult::selectRaw('student_id, AVG(score) as avg_score')
            ->groupBy('student_id')
            ->orderByDesc('avg_score')
            ->get()
            ->pluck('student_id')
            ->search($user->id);
        $ranking = $ranking !== false ? $ranking + 1 : null;

        // Leaderboard top 10
        $leaderboard = TryoutResult::with(['student:id,name'])
            ->select('student_id', DB::raw('AVG(score) as avg_score'))
            ->groupBy('student_id')
            ->orderByDesc('avg_score')
            ->take(10)
            ->get();

        return response()->json([
            'available_tryouts' => $availableTryouts,
            'done_tryouts' => $doneTryouts,
            'average_score' => round($averageScore, 2),
            'latest_materials' => $latestMaterials,
            'latest_result' => $latestResult,
            'ranking' => $ranking,
            'leaderboard' => $leaderboard,
        ]);
    }
}
