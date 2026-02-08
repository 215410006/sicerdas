<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;


class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('category');

        // Filter berdasarkan kategori
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search) {
            $query->where('question_text', 'like', '%' . $request->search . '%');
        }

        // Paginasi hasil query
        $questions = $query->paginate(10);
        $categories = QuestionCategory::all();

        return view('questions.index', compact('questions', 'categories'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
            'category_id' => 'nullable|exists:question_categories,id',
        ]);
    
        // Simpan file
        $filePath = $request->file('file')->store('imports');
        $fullPath = storage_path('app/' . $filePath);
    
        // Parsing file (contoh dengan PHPWord)
        $phpWord = IOFactory::load($fullPath);
        $text = '';
        foreach ($phpWord->getSections() as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }
        $questions = [
            [
                'question_text' => 'Soal 1 dari parsing',
                'options' => ['A', 'B', 'C', 'D'],
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'Soal 2 dari parsing',
                'options' => ['E', 'F', 'G', 'H'],
                'correct_answer' => 'G',
            ],
        ];
    
        // Simpan semua soal ke DB
        foreach ($questions as $q) {
            Question::create([
                'question_text' => $q['question_text'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'category_id' => $request->category_id,
            ]);
        }
    
        return redirect()->route('questions.index')->with('success', 'Soal berhasil diimport.');
    }
    

    public function create()
    {
        $categories = QuestionCategory::all();
        return view('questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text'  => 'required|string',
            'options'        => 'required|array|min:2',
            'options.*'      => 'required|string',
            'correct_answer' => 'required|string',
            'category_id'    => 'nullable|exists:question_categories,id',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan svg jika perlu
        ]);

        if (!in_array($request->correct_answer, $request->options)) {
            return back()->withErrors(['correct_answer' => 'Jawaban harus salah satu dari pilihan yang tersedia.'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Pastikan file adalah gambar
            if ($image->isValid()) {
                $imagePath = $image->store('question_images', 'public');
            } else {
                return back()->withErrors(['image' => 'File gambar tidak valid.'])->withInput();
            }
        }

        Question::create([
            'question_text'  => $request->question_text,
            'options'        => $request->options,
            'correct_answer' => $request->correct_answer,
            'image'          => $imagePath,
            'category_id'    => $request->category_id,
        ]);

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function edit(Question $question)
    {
        $categories = QuestionCategory::all();
        $question->options = $question->options; // Ubah JSON ke array
        return view('questions.edit', compact('question', 'categories'));
    }

    public function update(Request $request, Question $question)
    { 
        $request->validate([
            'question_text' => 'required',
            'options' => 'required|array|min:2',
            'correct_answer' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // Handle image
        if ($request->has('remove_image')) {
            // Hapus gambar lama
            Storage::delete('public/'.$question->image);
            $question->image = null;
        }

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($question->image) {
                Storage::delete('public/'.$question->image);
            }
            
            // Simpan gambar baru
            $path = $request->file('image')->store('question_images', 'public');
            $question->image = $path;
        }

        // Update data lainnya
        $question->update([
            'question_text' => $request->question_text,
            'options' => $request->options,
            'correct_answer' => $request->correct_answer,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('questions.index')->with('success', 'Data berhasil diupdate');
    }

    public function show(Question $question)
    {
        $question->load('category'); // Memuat relasi kategori
        return view('questions.show', compact('question'));
    }



    public function destroy(Question $question)
    {
        // Hapus pertanyaan
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dihapus');
    }
    
    public function byCategory($categoryId)
    {
        $questions = Question::where('category_id', $categoryId)->get(['id', 'question_text']);
        return response()->json($questions);
    }
    
}