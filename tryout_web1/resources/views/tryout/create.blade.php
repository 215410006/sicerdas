@extends('layouts.app')

@section('title', 'Tambah Tryout')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Tryout</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('tryout.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Tryout</h4>
                </div>
                <div class="card-body">

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Tryout</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_tryout" class="form-control @error('nama_tryout') is-invalid @enderror" value="{{ old('nama_tryout') }}">
                            @error('nama_tryout')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Mulai</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Selesai</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="datetime-local" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PILIH KATEGORI --}}
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Kategori</label>
                        <div class="col-sm-12 col-md-7">
                            <select id="category-select" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PILIH SOAL --}}
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pilih Soal</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="questions[]" id="question-select" class="form-control select2" multiple>
                                {{-- Soal akan dimuat otomatis lewat AJAX --}}
                            </select>
                            @error('questions')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        const questionSelect = document.getElementById('question-select');
        const categorySelect = document.getElementById('category-select');

        questionSelect.addEventListener('change', () => {
            if (questionSelect.selectedOptions.length > 0) {
                categorySelect.value = ""; 
            }
        });

        categorySelect.addEventListener('change', () => {
            if (categorySelect.value !== "") {
                for (let option of questionSelect.options) {
                    option.selected = false;
                }
                $('.select2').trigger('change');
            }
        });
    });
</script>
@endpush
