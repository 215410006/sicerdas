@extends('layouts.app')

@section('title', 'Hasil Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Hasil Tryout</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Hasil Tryout</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-bar"></i> Daftar Hasil Tryout</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari hasil...">
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
                                        <th>Nama Siswa</th>
                                        <th>Tryout</th>
                                        <th>Skor</th>
                                        <th>Detail</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($results as $result)
                                    <tr>
                                        <td>{{ optional($result->student)->name ?? '-' }}</td>
                                        <td>{{ optional($result->tryout)->nama_tryout ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-{{ 
                                                $result->score >= 75 ? 'success' : 
                                                ($result->score >= 50 ? 'warning' : 'danger')
                                            }}">
                                                {{ $result->score }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-icon btn-info" data-toggle="modal" data-target="#jawabanModal{{ $result->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>{{ $result->created_at->translatedFormat('d M Y H:i') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-icon btn-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-warning m-2">
                                                Belum ada hasil tryout yang tercatat.
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($results->hasPages())
                    <div class="card-footer text-right">
                        {{ $results->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal Jawaban --}}
@foreach ($results as $result)
<div class="modal fade" id="jawabanModal{{ $result->id }}" tabindex="-1" role="dialog" aria-labelledby="jawabanModalLabel{{ $result->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jawabanModalLabel{{ $result->id }}">
                    <i class="fas fa-file-alt"></i> Jawaban - {{ optional($result->student)->name }} ({{ optional($result->tryout)->nama_tryout }})
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Soal</th>
                                <th>Jawaban</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $decodedAnswers = json_decode($result->answers); @endphp
                            @if ($decodedAnswers)
                                @foreach($decodedAnswers as $questionId => $answer)
                                <tr>
                                    <td>Soal #{{ $questionId }}</td>
                                    <td>
                                        {{ is_object($answer) ? $answer->answer : $answer }}
                                    </td>
                                    <td>
                                        @if (is_object($answer))
                                            <span class="badge badge-{{ $answer->is_correct ? 'success' : 'danger' }}">
                                                {{ $answer->is_correct ? 'Benar' : 'Salah' }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada jawaban yang disimpan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
@if(session('success'))
<script>
    swal('Berhasil', '{{ session('success') }}', 'success');
</script>
@endif
@endpush
