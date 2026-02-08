<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory as WordReader;
use Smalot\PdfParser\Parser as PdfParser;
use App\Models\Question;
use App\Models\QuestionCategory;

class QuestionImportController extends Controller
{
    public function showImportForm()
    {
        $categories = QuestionCategory::all();
        return view('questions.import', compact('categories'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx',
            'category_id' => 'nullable|exists:question_categories,id',
        ]);

        $path = $request->file('file')->getPathName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $categoryId = $request->category_id;

        $text = '';

        if ($extension === 'pdf') {
            $parser = new PdfParser();
            $pdf = $parser->parseFile($path);
            $text = $pdf->getText();
        } elseif (in_array($extension, ['doc', 'docx'])) {
            $phpWord = WordReader::load($path);
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "\n";
                    }
                }
            }
        } else {
            return back()->withErrors(['file' => 'Format file tidak didukung.']);
        }

        // Parse teks menjadi pertanyaan (sederhana, bisa dikembangkan)
        // Format di dokumen: Soal diikuti pilihan (A, B, C...) dan jawaban
        // Contoh:
        // 1. Apa ibu kota Indonesia?
        // A. Bandung
        // B. Surabaya
        // C. Jakarta
        // Jawaban: C

        $pattern = '/\d+\.\s(.+?)\nA\.\s(.+?)\nB\.\s(.+?)\nC\.\s(.+?)\n(?:D\.\s(.+?)\n)?Jawaban:\s([A-D])/i';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $options = [
                'A' => trim($match[2]),
                'B' => trim($match[3]),
                'C' => trim($match[4]),
            ];

            if (!empty($match[5])) {
                $options['D'] = trim($match[5]);
                $correctAnswer = $options[$match[6]];
            } else {
                $correctAnswer = $options[$match[6]];
            }

            Question::create([
                'question_text'  => trim($match[1]),
                'options'        => array_values($options),
                'correct_answer' => $correctAnswer,
                'category_id'    => $categoryId,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Import soal berhasil!');
    }
}
