@extends('layouts.app')

@section('title', 'Daftar Soal - ' . $tryout->nama_tryout)

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Soal</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('tryout.index') }}">Tryout</a></div>
            <div class="breadcrumb-item active">Soal - {{ $tryout->nama_tryout }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-question-circle"></i> Soal Tryout: {{ $tryout->nama_tryout }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('questions.create', $tryout->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Soal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse($questions as $index => $question)
                        <div class="card question-card mb-4">
                            <div class="card-header">
                                <h5>Soal {{ $index + 1 }}</h5>
                                <div class="card-header-action">
                                    <a href="{{ route('questions.edit', [$tryout->id, $question->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('questions.destroy', [$tryout->id, $question->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus soal ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <p class="form-control-static">{{ $question->question_text }}</p>
                                </div>

                                <div class="form-group">
                                    <label>Pilihan Jawaban</label>
                                    <div class="options-list">
                                        @foreach($question->options as $key => $value)
                                        <div class="option-item {{ $key == $question->correct_answer ? 'correct-answer' : '' }}">
                                            <strong>{{ $key }}:</strong> {{ $value }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jawaban Benar</label>
                                    <p class="form-control-static correct-answer-badge">
                                        <span class="badge badge-success">{{ $question->correct_answer }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle"></i> Belum ada soal yang ditautkan untuk tryout ini.
                        </div>
                        @endforelse
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('tryout.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .question-card {
        border-left: 4px solid #6777ef;
    }
    .options-list {
        border: 1px solid #e4e6fc;
        border-radius: 4px;
        padding: 10px;
    }
    .option-item {
        padding: 8px;
        margin-bottom: 5px;
        border-radius: 3px;
        background-color: #f9fafb;
    }
    .correct-answer {
        background-color: #e3f7e8;
        border-left: 3px solid #28a745;
    }
    .correct-answer-badge {
        font-size: 1.1em;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
@endpush
