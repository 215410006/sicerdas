@extends('layouts.app')

@section('title', 'Laporan Skor Siswa')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Skor Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Skor</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-line"></i> Rekap Nilai Tryout</h4>
                        <div class="card-header-form">
                            <form method="GET" action="">
                                <div class="input-group">
                                    <select name="tryout_id" class="form-control select2">
                                        <option value="">Semua Tryout</option>
                                        @foreach($tryouts as $tryout)
                                            <option value="{{ $tryout->id }}" {{ request('tryout_id') == $tryout->id ? 'selected' : '' }}>
                                                {{ $tryout->nama_tryout }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
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
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tryout</th>
                                        <th>Skor</th>
                                        <th>Status</th>
                                        <th>Waktu Dikerjakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporanSkor as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $result->student->name ?? '-' }}</td>
                                        <td>{{ $result->tryout->nama_tryout ?? '-' }}</td>
                                        <td>
                                            <div class="badge badge-{{ $result->score >= 75 ? 'success' : ($result->score >= 50 ? 'warning' : 'danger') }}">
                                                {{ $result->score }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $now = now();
                                                $start = \Carbon\Carbon::parse($result->tryout->tanggal_mulai);
                                                $end = \Carbon\Carbon::parse($result->tryout->tanggal_selesai);
                                                
                                                if ($result->created_at < $start) {
                                                    $status = 'Awal';
                                                    $badge = 'secondary';
                                                } elseif ($result->created_at > $end) {
                                                    $status = 'Telat';
                                                    $badge = 'danger';
                                                } else {
                                                    $status = 'Tepat Waktu';
                                                    $badge = 'success';
                                                }
                                            @endphp
                                            <span class="badge badge-{{ $badge }}">{{ $status }}</span>
                                        </td>
                                        <td>{{ $result->created_at->translatedFormat('d M Y H:i') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-icon btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-icon btn-primary" title="Unduh">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-info-circle"></i> Belum ada data laporan skor.
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $laporanSkor->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<!-- @if(session('success'))
<script>
    swal('Berhasil', '{{ session('success') }}', 'success');
</script>
@endif -->
@endpush