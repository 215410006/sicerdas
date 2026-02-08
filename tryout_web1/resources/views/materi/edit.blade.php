@extends('layouts.app')

@section('title', 'Edit Materi')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Materi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('materi.index') }}">Materi</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-edit"></i> Edit Materi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Materi</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                           value="{{ old('judul', $materi->judul) }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="kategori_id" class="form-control selectric @error('kategori_id') is-invalid @enderror" required>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $materi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File Materi</label>
                                <div class="col-sm-12 col-md-7">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih file baru (PDF, MP4, MP3)</label>
                                    </div>
                                    @if($materi->file_path)
                                        <div class="mt-2">
                                            <span class="text-muted">File saat ini: </span>
                                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-sm btn-icon icon-left btn-light">
                                                <i class="fas fa-file"></i> Lihat File
                                            </a>
                                        </div>
                                    @endif
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('materi.index') }}" class="btn btn-secondary ml-2">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script>
    // Custom file input
    $(".custom-file-input").on("change", function() {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush