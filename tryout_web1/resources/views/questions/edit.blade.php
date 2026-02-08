@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('questions.index') }}">Daftar Soal</a></div>
            <div class="breadcrumb-item">Edit Soal</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Soal</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.update', $question->id) }}" method="POST" id="question-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pertanyaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="question_text" class="form-control @error('question_text') is-invalid @enderror" value="{{ old('question_text', $question->question_text) }}" required>
                                    @error('question_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $question->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilihan Jawaban</label>
                                <div class="col-sm-12 col-md-7" id="options-container">
                                    @foreach(old('options', $question->options ?? []) as $option)
                                        <input type="text" name="options[]" class="form-control mb-2" value="{{ $option }}" required>
                                    @endforeach
                                    <button type="button" id="add-option" class="btn btn-sm btn-secondary">+ Tambah Pilihan</button>
                                    @error('options') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jawaban Benar</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" value="{{ old('correct_answer', $question->correct_answer) }}" required>
                                    @error('correct_answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar (Opsional)</label>
                                <div class="col-sm-12 col-md-7">
                                    @if($question->image)
                                        <img src="{{ asset('storage/'.$question->image) }}" class="img-thumbnail mb-2" style="max-height: 200px;">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="remove_image" id="remove_image" class="form-check-input">
                                            <label for="remove_image" class="form-check-label text-danger">Hapus gambar ini</label>
                                        </div>
                                    @endif
                                    
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">Format: JPG, PNG, JPEG (Maks: 2MB)</small>
                                    
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('add-option').addEventListener('click', function() {
        let container = document.getElementById('options-container');
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'options[]';
        input.className = 'form-control mb-2';
        input.required = true;
        container.insertBefore(input, document.getElementById('add-option'));
    });

    // Validasi form sebelum submit
    document.getElementById('question-form').addEventListener('submit', function(event) {
        let options = document.querySelectorAll('input[name="options[]"]');
        let correctAnswer = document.querySelector('input[name="correct_answer"]').value;
        let isValid = true;

        // Minimal 2 pilihan jawaban
        if (options.length < 2) {
            alert('Minimal harus ada 2 pilihan jawaban.');
            isValid = false;
        }

        // Jawaban benar harus sesuai dengan salah satu pilihan
        let optionValues = Array.from(options).map(option => option.value);
        if (!optionValues.includes(correctAnswer)) {
            alert('Jawaban benar harus sesuai dengan salah satu pilihan jawaban.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Mencegah form disubmit jika validasi gagal
        }
    });
</script>
@endsection
