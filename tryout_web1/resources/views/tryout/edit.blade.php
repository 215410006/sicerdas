@extends('layouts.app')

@section('title', 'Edit Tryout')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Tryout</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('tryout.update', $tryout->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Tryout</h4>
                </div>
                <div class="card-body">

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tryout</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_tryout" class="form-control @error('nama_tryout') is-invalid @enderror" value="{{ old('nama_tryout', $tryout->nama_tryout) }}">
                            @error('nama_tryout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $tryout->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Mulai</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($tryout->tanggal_mulai)->format('Y-m-d\TH:i')) }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Selesai</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($tryout->tanggal_selesai)->format('Y-m-d\TH:i')) }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="draft" {{ old('status', $tryout->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status', $tryout->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="selesai" {{ old('status', $tryout->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
            
                    {{-- PILIH KATEGORI --}}
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Kategori</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="category_id" id="category-select" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- PILIH SOAL --}}
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Soal</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="questions[]" id="question-select" class="form-control select2 @error('questions') is-invalid @enderror" multiple>
                                {{-- Soal akan dimuat lewat JavaScript berdasarkan kategori --}}
                            </select>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('tryout.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Pilih soal tryout",
            allowClear: true
        });

        const allCategories = @json($categories);
        const selectedQuestions = @json($selectedQuestions);

        function loadQuestions(categoryId) {
            const category = allCategories.find(cat => cat.id == categoryId);
            const $questionSelect = $('#question-select');
            $questionSelect.empty();

            if (category && category.questions) {
                category.questions.forEach(q => {
                    const isSelected = selectedQuestions.includes(q.id);
                    const option = new Option(q.judul_soal, q.id, isSelected, isSelected);
                    $questionSelect.append(option);
                });
            }

            $questionSelect.trigger('change');
        }

        // Load saat halaman pertama kali terbuka (jika category terisi)
        const initialCategoryId = $('#category-select').val();
        if (initialCategoryId) {
            loadQuestions(initialCategoryId);
        }

        $('#category-select').change(function () {
            const categoryId = $(this).val();
            loadQuestions(categoryId);
        });
    });
</script>

@endpush

