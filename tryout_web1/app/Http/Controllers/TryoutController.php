<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\Question;
use App\Models\TryoutResult;
use App\Models\TryoutAnswer;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class TryoutController extends Controller
{
    public function index()
    {
        $tryouts = Tryout::with('questions')->paginate(10); // <- HARUS paginate(), bukan get()

        return view('tryout.index', compact('tryouts'));
    }
    public function create()
    {
        $categories = QuestionCategory::with('questions')->get(); 
        return view('tryout.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tryout' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:draft,publish,selesai',
            'questions' => 'nullable|array',
            'questions.*' => 'exists:questions,id',
            'category_id' => 'nullable|exists:question_categories,id',
        ]);
    
        $tryout = Tryout::create([
            'nama_tryout' => $request->nama_tryout,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);
        
    
        // Jika user memilih soal secara manual
        if ($request->filled('questions')) {
            $tryout->questions()->attach($request->questions);
        }
    
        // Jika user memilih berdasarkan kategori soal
        elseif ($request->filled('category_id')) {
            $questions = Question::where('category_id', $request->category_id)->pluck('id');
            $tryout->questions()->attach($questions);
        }
        // dd($request->all());
    
        return redirect()->route('tryout.index')->with('success', 'Tryout berhasil dibuat.');
    }
    

    public function edit($id)
    {
        $tryout = Tryout::with('questions')->findOrFail($id);
        $categories = QuestionCategory::with('questions')->get();
        $selectedQuestions = $tryout->questions->pluck('id')->toArray();

        return view('tryout.edit', compact('tryout', 'categories', 'selectedQuestions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tryout' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:draft,publish,selesai',
            'questions' => 'nullable|array',
            'questions.*' => 'exists:questions,id',
            'category_id' => 'nullable|exists:question_categories,id',
        ]);

        $tryout = Tryout::findOrFail($id);

        $tryout->update([
            'nama_tryout' => $request->nama_tryout,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
        ]);

        // Update soal berdasarkan input yang tersedia
        if ($request->filled('questions')) {
            $tryout->questions()->sync($request->questions);
        } elseif ($request->filled('category_id')) {
            $questions = Question::where('category_id', $request->category_id)->pluck('id');
            $tryout->questions()->sync($questions);
        } else {
            $tryout->questions()->detach(); // Tidak ada soal dipilih
        }

        return redirect()->route('tryout.index')->with('success', 'Tryout berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $tryout = Tryout::findOrFail($id);
        $tryout->questions()->detach();
        $tryout->delete();

        return redirect()->route('tryout.index')->with('success', 'Tryout berhasil dihapus.');
    }

    public function showQuestions($tryoutId)
    {
        // Ambil tryout beserta soal-soalnya
        $tryout = Tryout::findOrFail($tryoutId);

        // Ambil soal-soal yang terkait dengan tryout
        // Misal relasi: tryout->questions()
        $questions = $tryout->questions()->get();

        return view('tryout.soal', compact('tryout', 'questions'));
    }

    public function leaderboard()
    {
        $leaderboards = \App\Models\TryoutResult::with(['student', 'tryout'])
            ->whereNotNull('score')
            ->orderByDesc('score')
            ->paginate(50); 
        return view('tryout.leaderboard', compact('leaderboards'));
    }

    public function schedule(Request $request)
    {
        $query = Tryout::query();

        if ($request->filled('tanggal')) {
            $date = \Carbon\Carbon::parse($request->tanggal);
            $query->whereDate('tanggal_mulai', '<=', $date)
                ->whereDate('tanggal_selesai', '>=', $date);
        }

        $upcomingTryouts = $query->orderBy('tanggal_mulai')->paginate(10);

        return view('tryout.schedule', compact('upcomingTryouts'));
    }

    public function result()
    {
        $results = TryoutResult::with(['student', 'tryout'])
            ->where('student_id', auth()->id())
            ->latest()
            ->paginate(10);
    
        return view('tryout.result', compact('results'));
    }
    public function saveAnswer(Request $request)
    {
        $data = $request->validate([
            'tryout_id' => 'required|exists:tryouts,id',
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
        ]);

        TryoutAnswer::updateOrCreate(
            [
                'tryout_id' => $data['tryout_id'],
                'student_id' => auth()->id(),
                'question_id' => $data['question_id'],
            ],
            [
                'answer' => $data['answer'],
            ]
        );

        return response()->json(['status' => 'saved']);
    }
}
