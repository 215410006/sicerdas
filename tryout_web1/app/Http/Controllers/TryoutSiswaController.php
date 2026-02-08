<?php

namespace App\Http\Controllers;


use App\Models\Tryout;
use App\Models\TryoutResult;
use Illuminate\Http\Request;
use App\Models\TryoutAnswer;
use Carbon\Carbon;

class TryoutSiswaController extends Controller
{
    public function kerjakan($id)
    {
        $tryout = Tryout::with('questions')->findOrFail($id);

        $now = Carbon::now('Asia/Jakarta');
        $startTime = Carbon::parse($tryout->tanggal_mulai, 'Asia/Jakarta');
        $endTime = Carbon::parse($tryout->tanggal_selesai, 'Asia/Jakarta');

        // Validasi waktu mulai dan selesai
        if ($now->lt($startTime)) {
            return redirect()->route('tryout.schedule')
                ->with('error', 'Tryout belum dimulai.');
        }

        if ($now->gt($endTime)) {
            return redirect()->route('tryout.schedule')
                ->with('error', 'Waktu tryout sudah berakhir.');
        }

        // Cek apakah user sudah mengerjakan tryout ini
        $sudahMengerjakan = TryoutResult::where('student_id', auth()->id())
            ->where('tryout_id', $id)
            ->exists();

        if ($sudahMengerjakan) {
            return redirect()->route('tryout.result', ['id' => $id])
                ->with('error', 'Kamu sudah mengerjakan tryout ini.');
        }

        // Hitung sisa waktu dalam detik
        $remainingTime = $endTime->diffInSeconds($now);

        // Ambil soal & jawaban
        $questions = $tryout->questions;
        $savedAnswers = TryoutAnswer::where('tryout_id', $tryout->id)
            ->where('student_id', auth()->id())
            ->pluck('answer', 'question_id');

        return view('tryout.kerjakan', compact('tryout', 'questions', 'savedAnswers', 'remainingTime'));
    }

    
    public function submit(Request $request, $id)
    {
        $tryout = Tryout::findOrFail($id);
        $answers = $request->input('answers');

        $score = 0;
        foreach ($answers as $questionId => $studentAnswer) {
            $question = \App\Models\Question::find($questionId);
            if ($question && $studentAnswer == $question->correct_answer) {
                $score += 1;
            }
        }

        // Simpan hasil ke tabel tryout_results dengan kolom student_id
        \App\Models\TryoutResult::updateOrCreate([
            'student_id' => auth()->id(), // sesuai dengan migration
            'tryout_id' => $tryout->id,
        ], [
            'score' => $score,
            'answers' => json_encode($answers),
        ]);

        return redirect()->route('tryout.schedule')->with('success', 'Tryout selesai dikerjakan!');
    }

}
