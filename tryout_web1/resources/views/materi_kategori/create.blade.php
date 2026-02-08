@extends('layouts.app')

@section('title', 'Tambah Kategori Materi')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Kategori Materi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('materi_kategori.index') }}">Kategori Materi</a></div>
            <div class="breadcrumb-item active">Tambah Baru</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('materi_kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
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