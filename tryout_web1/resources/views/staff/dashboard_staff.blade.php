@extends('layouts.app')

@section('title', 'Dashboard Staff — SiCERDAS')

@section('content')
<div class="row">
  <!-- Statistik Soal -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-book"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Soal</h4>
        </div>
        <div class="card-body">
          {{ $totalSoal }}
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Materi -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-success bg-success">
        <i class="fas fa-file-alt"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Materi</h4>
        </div>
        <div class="card-body">
          {{ $totalMateri }}
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Tryout -->
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-icon shadow-warning bg-warning">
        <i class="fas fa-tasks"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Tryout yang Dibuat</h4>
        </div>
        <div class="card-body">
          {{ $totalTryout }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Soal Terbaru -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Soal Terbaru</h4>
        <div class="card-header-action">
          <a href="{{ route('questions.index') }}" class="btn btn-primary">Lihat Semua</a>
        </div>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @forelse($latestQuestions as $question)
            <li class="list-group-item">{{ $question->title }}</li>
          @empty
            <li class="list-group-item text-muted">Belum ada soal</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

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
          @forelse($latestMateri as $materi)
            <li class="list-group-item">{{ $materi->judul }}</li>
          @empty
            <li class="list-group-item text-muted">Belum ada materi</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Tombol Aksi -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body text-center">
        <a href="{{ route('questions.create') }}" class="btn btn-primary btn-lg mx-2">
          <i class="fas fa-plus"></i> Tambah Soal Baru
        </a>
        <a href="{{ route('materi.create') }}" class="btn btn-success btn-lg mx-2">
          <i class="fas fa-upload"></i> Unggah Materi
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
  