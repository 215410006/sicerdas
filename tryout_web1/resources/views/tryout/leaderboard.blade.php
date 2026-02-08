@extends('layouts.app')

@section('title', 'Leaderboard Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Leaderboard Tryout</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Leaderboard</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-trophy"></i> Peringkat Tryout</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari siswa...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Siswa</th>
                                        <th>Tryout</th>
                                        <th>Skor</th>
                                        <th>Tanggal</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leaderboards as $index => $result)
                                    <tr>
                                        <td>
                                            @if($index < 3)
                                                <span class="badge badge-{{ ['warning', 'secondary', 'danger'][$index] }}">
                                                    <i class="fas fa-medal"></i> {{ $index + 1 }}
                                                </span>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td>{{ $result->student->name ?? '-' }}</td>
                                        <td>{{ $result->tryout->nama_tryout ?? '-' }}</td>
                                        <td>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-{{ $result->score >= 80 ? 'success' : ($result->score >= 50 ? 'warning' : 'danger') }}" 
                                                     role="progressbar" 
                                                     style="width: {{ $result->score }}%"
                                                     aria-valuenow="{{ $result->score }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $result->score }} poin</small>
                                        </td>
                                        <td>{{ $result->created_at->translatedFormat('d M Y H:i') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-icon btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-info-circle"></i> Belum ada data leaderboard.
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $leaderboards->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .progress {
        background-color: #e9ecef;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .badge i.fas {
        margin-right: 3px;
    }
</style>
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

@endpush