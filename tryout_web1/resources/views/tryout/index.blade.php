@extends('layouts.app')

@section('title', 'Daftar Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Tryout</h1>
        @auth
            @if(auth()->user()->role !== 'student')
                <div class="section-header-button">
                    <a href="{{ route('tryout.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Tryout
                    </a>
                </div>
            @endif
        @endauth
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Tryout</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Kelola Tryout</h2>
        <p class="section-lead">Halaman ini digunakan untuk mengelola daftar tryout yang tersedia.</p>

        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>×</span></button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-clipboard-list"></i> Data Tryout</h4>
                        <div class="card-header-form">
                            <form action="#" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari tryout..." name="search" value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tryout</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Soal</th>
                                    @auth
                                        @if(auth()->user()->role !== 'student')
                                            <th>Aksi</th>
                                        @endif
                                    @endauth
                                </tr>
                            </thead>
                                <tbody>
                                    @forelse($tryouts as $tryout)
                                        <tr>
                                            <td>{{ $loop->iteration + ($tryouts->currentPage() - 1) * $tryouts->perPage() }}</td>
                                            <td>{{ $tryout->nama_tryout }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tryout->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tryout->tanggal_selesai)->format('d M Y') }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = match($tryout->status) {
                                                        'draft' => 'secondary',
                                                        'publish' => 'success',
                                                        'selesai' => 'danger',
                                                        default => 'info',
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $badgeClass }}">{{ ucfirst($tryout->status) }}</span>
                                                <td>{{ $tryout->questions->count() }}</td>

                                                @auth
                                                    @if(auth()->user()->role !== 'student')
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('tryout.edit', $tryout->id) }}" class="btn btn-sm btn-icon btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('tryout.soal', $tryout->id) }}" class="btn btn-sm btn-icon btn-info" title="Lihat Soal">
                                                                <i class="fas fa-book-open"></i>
                                                            </a>
                                                            <form action="{{ route('tryout.destroy', $tryout->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus tryout ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                @endauth
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data tryout.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $tryouts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
@endpush
