@extends('layouts.app')

@section('title', 'Daftar Soal')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Soal</h1>
        <div class="section-header-button">
            <a href="{{ route('questions.create') }}" class="btn btn-primary">Tambah Soal</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Import --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Import Soal (PDF / Word)</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('questions.import') }}" method="POST" enctype="multipart/form-data" class="form-row align-items-center">
                @csrf
                <div class="col-sm-4 my-1">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-sm-4 my-1">
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto my-1">
                    <button class="btn btn-success" type="submit">Import</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Filter dan Tabel Soal --}}
    <div class="card">
        <div class="card-header">
            <h4>Daftar Soal</h4>
            <div class="card-header-action">
                <form action="{{ route('questions.index') }}" method="GET" class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <select name="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 my-1">
                        <input type="text" name="search" class="form-control" placeholder="Cari soal..." value="{{ request('search') }}">
                    </div>
                    <div class="col-auto my-1">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Kategori</th>
                            <th>Pilihan</th>
                            <th>Jawaban</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $index => $question)
                        <tr>
                            <td>{{ $questions->firstItem() + $index }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->category->name ?? '-' }}</td>
                            <td>
                                <ul class="pl-3 mb-0">
                                    @foreach($question->options as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><strong>{{ $question->correct_answer }}</strong></td>
                            <td>
                                @if($question->image)
                                    <img src="{{ asset('storage/'.$question->image) }}" width="60" class="img-thumbnail">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm mb-1">Lihat</a>
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data soal.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center flex-wrap">
                        {{ $questions->withQueryString()->links('pagination::bootstrap-4') }}
                    </ul>
               </nav>
            </div>
        </div>
    </div>
</section>
@endsection
