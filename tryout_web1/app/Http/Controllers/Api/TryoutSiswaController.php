<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutAnswer;
use App\Models\TryoutResult;
use App\Models\Question;
use Carbon\Carbon;

class TryoutSiswaController extends Controller
{
    /**
     * Endpoint untuk mulai mengerjakan tryout.
     */
    public function kerjakan($id, Request $request)
    {
        $tryout = Tryout::with('questions')->findOrFail($id);

        $now = Carbon::now('Asia/Jakarta');
        $startTime = Carbon::parse($tryout->tanggal_mulai, 'Asia/Jakarta');
        $endTime = Carbon::parse($tryout->tanggal_selesai, 'Asia/Jakarta');

        // Validasi waktu
        if ($now->lt($startTime)) {
            return response()->json(['message' => 'Tryout belum dimulai.'], 403);
        }

        if ($now->gt($endTime)) {
            return response()->json(['message' => 'Waktu tryout sudah berakhir.'], 403);
        }

        // Cek apakah user sudah mengerjakan
        $sudahMengerjakan = TryoutResult::where('student_id', $request->user()->id)
            ->where('tryout_id', $id)
            ->exists();

        if ($sudahMengerjakan) {
            return response()->json(['message' => 'Kamu sudah mengerjakan tryout ini.'], 403);
        }

        // Sisa waktu dalam detik
        $remainingTime = $endTime->diffInSeconds($now);

        // Ambil saved answers (jika perlu)
        $savedAnswers = TryoutAnswer::where('tryout_id', $id)
            ->where('student_id', $request->user()->id)
            ->pluck('answer', 'question_id');

        return response()->json([
            'tryout' => $tryout,
            'remaining_time' => $remainingTime,
            'saved_answers' => $savedAnswers,
        ]);
    }

    /**
     * Endpoint untuk submit hasil tryout.
     */
    public function submit(Request $request, $id)
    {
        $user = $request->user();
        $tryout = Tryout::findOrFail($id);
        $answers = $request->input('answers'); // format: {question_id: 'A'}

        $score = 0;

        foreach ($answers as $questionId => $studentAnswer) {
            $question = Question::find($questionId);

            // Koreksi jawaban
            if ($question && $studentAnswer === $question->correct_answer) {
                $score += 1;
            }

            // Simpan jawaban siswa
            TryoutAnswer::updateOrCreate(
                [
                    'student_id' => $user->id,
                    'tryout_id' => $tryout->id,
                    'question_id' => $questionId,
                ],
                [
                    'answer' => $studentAnswer,
                ]
            );
        }

        // Simpan hasil tryout
        TryoutResult::updateOrCreate(
            [
                'student_id' => $user->id,
                'tryout_id' => $tryout->id,
            ],
            [
                'score' => $score,
                'answers' => json_encode($answers),
            ]
        );

        return response()->json([
            'message' => 'Tryout berhasil disubmit.',
            'score' => $score,
        ]);
    }
}
