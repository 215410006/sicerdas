@extends('layouts.app')

@section('title', 'Kehadiran Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kehadiran Tryout</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Kehadiran</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-user-check"></i> Data Kehadiran Tryout</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Tryout</th>
                            <th>Skor</th>
                            <th>Waktu Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kehadiran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->student->name ?? '-' }}</td>
                            <td>{{ $item->tryout->nama_tryout ?? '-' }}</td>
                            <td>{{ $item->score ?? '-' }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data kehadiran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
