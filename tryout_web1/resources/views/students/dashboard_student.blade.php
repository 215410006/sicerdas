@extends('layouts.app')

@section('title', 'Dashboard Siswa — SiCERDAS')

@section('content')
<div class="row">
  <!-- Statistik Tryout Tersedia -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-info bg-info">
        <i class="fas fa-list-ol"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Tryout Tersedia</h4>
        </div>
        <div class="card-body">
          @foreach($availableTryouts as $tryout)
            <li>{{ $tryout->nama_tryout }}</li>
          @endforeach

        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Hasil Tryout -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-warning bg-warning">
        <i class="fas fa-clipboard-check"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Tryout Dikerjakan</h4>
        </div>
        <div class="card-body">
          {{ $doneTryouts }}
        </div>
      </div>
    </div>
  </div>

  <!-- Skor Rata-rata -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-success bg-success">
        <i class="fas fa-star"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Rata-rata Skor</h4>
        </div>
        <div class="card-body">
          {{ $averageScore }}
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Materi dan Hasil Terakhir -->
<div class="row">
  <!-- Materi Terbaru -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Materi Terbaru</h4>
        <div class="card-header-action">
          <a href="{{ route('materi.index') }}" class="btn btn-success">Lihat Semua</a>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @forelse($latestMaterials as $material)
            <li class="list-group-item">{{ $material->title }}</li>
          @empty
            <li class="list-group-item">Belum ada materi.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  <!-- Hasil Tryout Terakhir -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Hasil Tryout Terakhir</h4>
        <div class="card-header-action">
          @if($lastTryout)
            <a href="{{ route('tryout.result', ['id' => $lastTryout->id]) }}" class="btn btn-primary">Lihat Riwayat</a>
          @else
            <button class="btn btn-secondary" disabled>Belum Ada Riwayat</button>
          @endif
        </div>

      </div>
      <div class="card-body">
        @if($latestResult)
          <p><strong>{{ $latestResult->tryout->title }}</strong></p>
          <p>Skor: <strong>{{ $latestResult->score }}</strong></p>
          <p>Tanggal: {{ $latestResult->created_at->format('d M Y') }}</p>
        @else
          <p>Belum ada hasil tryout.</p>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Tombol Aksi -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('tryout.index') }}" class="btn btn-primary btn-lg mx-2">
          <i class="fas fa-play-circle"></i> Ikuti Tryout
        </a>
        <a href="{{ route('materi.index') }}" class="btn btn-info btn-lg mx-2">
          <i class="fas fa-book-open"></i> Lihat Materi
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
