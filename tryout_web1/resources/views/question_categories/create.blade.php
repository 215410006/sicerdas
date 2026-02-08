@extends('layouts.app')

@section('title', 'Tambah Kategori Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Kategori Soal</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('question_categories.index') }}">Kategori Soal</a></div>
            <div class="breadcrumb-item">Tambah Kategori</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Kategori Soal</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('question_categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('question_categories.index') }}" class="btn btn-secondary">Batal</a>
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