@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Materi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('materi.index') }}">Materi</a></div>
                <div class="breadcrumb-item active">{{ $materi->judul }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-primary mb-0">{{ $materi->judul }}</h4>
                            <a href="{{ route('materi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Kategori</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $materi->kategori->nama ?? '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Tanggal Upload</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $materi->created_at->format('d F Y') }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Deskripsi</strong></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                    </div>
                                    <textarea class="form-control" readonly>{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</textarea>
                                </div>
                            </div>

                            @if ($materi->file_path)
                            <div class="mb-3">
                                <label><strong>File Materi</strong></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ basename($materi->file_path) }}" readonly>
                                    <div class="input-group-append">
                                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Ukuran file: {{ round(filesize(storage_path('app/public/' . $materi->file_path)) / 1024, 2) }} KB
                                </small>
                            </div>
                            @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-state-icon">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                </div>
                                <h4 class="mt-3">Tidak Ada File</h4>
                                <p class="lead">Tidak ada file yang diunggah untuk materi ini.</p>
                            </div>
                            @endif
                        </div>

                        @if(auth()->user()->role !== 'student')
                        <div class="card-footer bg-whitesmoke text-right">
                            <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<style>
    .form-control[readonly] {
        background-color: #fdfdff;
        border-color: #e4e6fc;
    }

    textarea.form-control {
        min-height: 120px;
    }

    .empty-state-icon {
        color: #ccc;
    }
</style>
@endpush
