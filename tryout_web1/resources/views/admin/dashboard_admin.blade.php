@extends('layouts.app')

@section('title', 'Dashboard Admin — UTBK Learning')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        </div>
    </div>

    <div class="section-body">
        <!-- Statistik Cards -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-2 card-primary">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Soal</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($totalSoal) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-2 card-success">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Materi</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($totalMateri) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card card-statistic-2 card-warning">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengguna</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($totalPengguna) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-bar"></i> Statistik Tryout</h4>
                        <div class="card-header-action">
                            <select class="form-control form-control-sm" id="filterChart">
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                                <option value="all">Semua Data</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="tryoutChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-trophy"></i> Top 3 Leaderboard</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border user-list">
                            @foreach($leaderboard as $index => $item)
                            <li class="media">
                                <div class="media-left media-middle">
                                    <div class="rank-badge">{{ $index + 1 }}</div>
                                </div>
                                <div class="media-body">
                                    <div class="media-title">{{ $item->student->name ?? 'N/A' }}</div>
                                    <div class="text-small text-muted">ID: {{ $item->student_id }}</div>
                                </div>
                                <div class="media-right">
                                    <div class="badge badge-primary">{{ $item->max_score }} pts</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .card-statistic-2 {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.03);
    }
    
    .card-statistic-2 .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .card-statistic-2 .card-body {
        font-size: 24px;
        font-weight: 600;
    }
    
    .user-list .media {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .user-list .media:last-child {
        border-bottom: none;
    }
    
    .rank-badge {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #6777ef;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 15px;
    }
    
    .rank-badge:nth-child(1) {
        background: #ffc107;
    }
    
    .rank-badge:nth-child(2) {
        background: #6c757d;
    }
    
    .rank-badge:nth-child(3) {
        background: #fd7e14;
    }
    
    .chart-container {
        min-height: 300px;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Chart
        const ctx = document.getElementById('tryoutChart');
        if (ctx) {
            const chartData = {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Rata-rata Skor',
                    data: @json($chartData),
                    backgroundColor: 'rgba(103, 119, 239, 0.5)',
                    borderColor: 'rgba(103, 119, 239, 1)',
                    borderWidth: 2,
                    borderRadius: 4,
                    barPercentage: 0.7
                }]
            };

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' poin';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100,
                        ticks: {
                            callback: function(value) {
                                return value + ' pts';
                            }
                        }
                    }
                }
            };

            const tryoutChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });

            // Filter chart handler
            document.getElementById('filterChart').addEventListener('change', function() {
                // Here you would typically make an AJAX call to get filtered data
                // For now we'll just show an alert
                alert('Filter functionality would fetch new data for: ' + this.value + ' days');
            });
        }
    });
</script>
@endpush