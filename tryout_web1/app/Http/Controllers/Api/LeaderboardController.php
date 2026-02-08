<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TryoutResult;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboards = TryoutResult::with(['student', 'tryout'])
            ->whereNotNull('score')
            ->orderByDesc('score')
            ->limit(50)
            ->get()
            ->map(function ($result) {
                return [
                    'student_id' => $result->student_id,
                    'student_name' => $result->student->name ?? '-',
                    'tryout_id' => $result->tryout_id,
                    'tryout_name' => $result->tryout->nama_tryout ?? '-',
                    'score' => $result->score,
                    'submitted_at' => $result->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $leaderboards,
        ]);
    }
}
