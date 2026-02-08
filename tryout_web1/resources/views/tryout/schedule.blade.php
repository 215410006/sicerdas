@extends('layouts.app')

@section('title', 'Jadwal Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Jadwal Tryout</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Jadwal Tryout</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-calendar-alt"></i> Daftar Tryout</h4>
                        <div class="card-header-form">
                            <form method="GET" action="{{ route('tryout.schedule') }}">
                                <div class="input-group">
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ request('tanggal') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($upcomingTryouts->isEmpty())
                            <div class="alert alert-warning alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>×</span></button>
                                    Tidak ada tryout pada tanggal tersebut.
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Tryout</th>
                                            <th>Deskripsi</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($upcomingTryouts as $tryout)
                                        <tr>
                                            <td>{{ $tryout->nama_tryout }}</td>
                                            <td>{{ Str::limit($tryout->deskripsi, 50) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tryout->tanggal_mulai)->translatedFormat('d M Y H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tryout->tanggal_selesai)->translatedFormat('d M Y H:i') }}</td>
                                            <td>
                                                @php
                                                    $now = now();
                                                    $start = \Carbon\Carbon::parse($tryout->tanggal_mulai);
                                                    $end = \Carbon\Carbon::parse($tryout->tanggal_selesai);

                                                    if ($now < $start) {
                                                        $status = 'Akan Datang';
                                                        $badge = 'warning';
                                                    } elseif ($now > $end) {
                                                        $status = 'Selesai';
                                                        $badge = 'secondary';
                                                    } else {
                                                        $status = 'Berlangsung';
                                                        $badge = 'success';
                                                    }
                                                @endphp
                                                <span class="badge badge-{{ $badge }}">{{ $status }}</span>
                                            </td>
                                            <td>
                                                @if($status == 'Berlangsung')
                                                    <a href="{{ route('tryout.kerjakan', $tryout->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Kerjakan
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Kerjakan</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    @if($upcomingTryouts->hasPages())
                    <div class="card-footer text-right">
                        {{ $upcomingTryouts->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

@if(session('success'))
<script>
    swal('Berhasil', '{{ session('success') }}', 'success');
</script>
@endif
@endpush
