@extends('layouts.app')

@section('title', 'Import Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Import Soal</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('questions.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">File Soal (PDF / Word)</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori (Opsional)</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Import</button>
        </form>
    </div>
</section>
@endsection
