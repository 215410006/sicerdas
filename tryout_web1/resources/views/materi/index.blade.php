@extends('layouts.app')

@section('title', 'Daftar Materi')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Materi</h1>

        @if(auth()->user()->role !== 'student')
        <div class="section-header-button">
            <a href="{{ route('materi.create') }}" class="btn btn-primary">Tambah Materi</a>
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Materi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materis as $index => $materi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $materi->judul }}</td>
                                        <td>{{ $materi->kategori->nama }}</td>
                                        <td>
                                            @if ($materi->file_path)
                                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-icon btn-info">
                                                    <i class="fas fa-file"></i>
                                                </a>
                                            @else
                                                <span class="badge badge-secondary">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('materi.show', $materi->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                            @if(auth()->user()->role !== 'student')
                                            <div class="btn-group">
                                                <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-warning btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Hapus materi ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            {{ $materis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
