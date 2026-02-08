@extends('layouts.app')

@section('title', 'Kemajuan Siswa')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kemajuan Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Kemajuan Siswa</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-line"></i> Perkembangan Nilai Tryout</h4>
                        <div class="card-header-form">
                            <form method="GET" action="">
                                <div class="input-group">
                                    <select name="student_id" class="form-control select2">
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}
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
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="chart-container" style="position: relative; height:300px;">
                                @if(count($data) > 0)
                                        <canvas id="chartKemajuan"></canvas>
                                    @else
                                        <p class="text-muted">Belum ada data tryout untuk siswa ini.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-box">
                                    <h5>Ringkasan Kemajuan</h5>
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <span>Rata-rata Skor:</span>
                                                <strong>{{ number_format($averageScore, 2) }}</strong>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <span>Skor Tertinggi:</span>
                                                <strong class="text-success">{{ $highestScore }}</strong>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <span>Skor Terendah:</span>
                                                <strong class="text-danger">{{ $lowestScore }}</strong>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <span>Jumlah Tryout:</span>
                                                <strong>{{ count($data) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
<style>
    .summary-box {
        background: #f8f9fa;
        border-radius: 5px;
        padding: 15px;
        height: 100%;
    }
    .summary-box h5 {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
</style>
@endpush

@@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        // Periksa apakah elemen chart ada sebelum membuat chart
        const ctx = document.getElementById('chartKemajuan');
        if (ctx) {
            const chartData = {
                labels: @json($labels),
                datasets: [{
                    label: 'Perkembangan Skor Tryout',
                    data: @json($data),
                    backgroundColor: 'rgba(103, 119, 239, 0.2)',
                    borderColor: 'rgba(103, 119, 239, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(103, 119, 239, 1)',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            };

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100,
                        ticks: {
                            callback: function(value) {
                                return value + ' poin';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' poin';
                            }
                        }
                    }
                }
            };

            try {
                new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: chartOptions
                });
            } catch (error) {
                console.error('Error initializing chart:', error);
            }
        }
    });
</script>
