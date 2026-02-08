@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('questions.index') }}">Daftar Soal</a></div>
            <div class="breadcrumb-item">Tambah Soal</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Soal</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data" id="question-form">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pertanyaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="question_text" class="form-control @error('question_text') is-invalid @enderror" required>
                                    @error('question_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilihan Jawaban</label>
                                <div class="col-sm-12 col-md-7" id="options-container">
                                    <input type="text" name="options[]" class="form-control mb-2" required>
                                    <input type="text" name="options[]" class="form-control mb-2" required>
                                    <button type="button" id="add-option" class="btn btn-sm btn-secondary">+ Tambah Pilihan</button>
                                    @error('options') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jawaban Benar</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" required>
                                    @error('correct_answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar (Opsional)</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" class="form-control @error('image') is-invalid @enderror">
                                    @error('image') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, JPEG, GIF, SVG | Maks: 2MB</small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

        // Validasi ukuran file sebelum submit
        let imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            let fileSize = imageInput.files[0].size / 1024 / 1024; // Convert ke MB
            if (fileSize > 2) {
                alert('Ukuran gambar maksimal 2MB.');
                isValid = false;
            }
        }

        if (!isValid) {
            event.preventDefault(); // Mencegah form disubmit jika validasi gagal
        }
    });
</script>
@endsection
