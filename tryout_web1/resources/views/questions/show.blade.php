@extends('layouts.app')

@section('title', 'Detail Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Soal</h1>
        <div class="section-header-button">
            <a href="{{ route('questions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $question->question_text }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Kategori:</strong> {{ $question->category->name ?? '-' }}
                        </div>

                        <div class="mb-3">
                            <strong>Pilihan Jawaban:</strong>
                            <ul>
                                @foreach($question->options as $option)
                                    <li @if($option === $question->correct_answer) class="text-success font-weight-bold" @endif>
                                        {{ $option }}
                                        @if($option === $question->correct_answer)
                                            <span class="badge badge-success ml-1">Jawaban Benar</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <strong>Gambar Soal:</strong><br>
                            @if($question->image)
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Soal" class="img-fluid img-thumbnail mt-2" style="max-width: 300px;">
                            @else
                                <p>Tidak ada gambar.</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
