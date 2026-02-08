<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use App\Models\Question;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Mengambil daftar kategori soal.
     */
    public function categories()
    {
        return response()->json(
            QuestionCategory::select('id', 'name')->get()
        );
    }

    /**
     * Mengambil daftar soal berdasarkan kategori.
     */
    public function soal($categoryId)
    {
        $questions = Question::where('category_id', $categoryId)
            ->select('id', 'question_text', 'options', 'correct_answer')
            ->get()
            ->map(function ($q) {
                $options = is_array($q->options)
                    ? $q->options
                    : json_decode($q->options ?? '[]', true); // <- ini penting!
    
                return [
                    'id' => $q->id,
                    'question_text' => $q->question_text,
                    'correct_answer' => $q->correct_answer,
                    'options' => $options, // pastikan array asli
                ];
            });
    
        return response()->json($questions);
    }
    

    

    /**
     * Mengoreksi jawaban yang dikirim siswa.
     */
    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        $corrections = [];

        foreach ($answers as $qid => $answer) {
            $question = Question::find($qid);
            if (!$question) continue;

            $isCorrect = $question->correct_answer === $answer;

            $corrections[] = [
                'question_text' => $question->question_text,
                'your_answer' => $answer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
            ];
        }

        return response()->json([
            'message' => 'Jawaban dikoreksi.',
            'corrections' => $corrections,
        ]);
    }
}
