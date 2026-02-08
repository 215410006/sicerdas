<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    public function index()
    {
        $categories = QuestionCategory::all();
        return view('question_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('question_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:question_categories']);
        QuestionCategory::create(['name' => $request->name]);

        return redirect()->route('question_categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(QuestionCategory $category)
    {
        return view('question_categories.edit', compact('category'));
    }

    public function update(Request $request, QuestionCategory $category)
    {
        $request->validate(['name' => 'required|unique:question_categories,name,' . $category->id]);
        $category->update(['name' => $request->name]);

        return redirect()->route('question_categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(QuestionCategory $id)
    {
        $id->delete();
        return redirect()->route('question_categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
