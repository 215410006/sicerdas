@extends('layouts.app')

@section('title', 'Profil Pengguna — EduPrep')

@section('content')
<!-- ======= Profile Section ======= -->
<section id="profile" class="profile">
  <div class="container" data-aos="fade-up">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil Pengguna</li>
      </ol>
    </nav>

    <div class="section-title">
      <h2>Profil Pengguna</h2>
      <p>Informasi akun dan profil Anda</p>
    </div>

    <div class="card profile-card">
      <div class="card-header">
        <h4>Profil: {{ $user->name }}</h4>
      </div>
      <div class="card-body">
        <!-- Name Field -->
        <div class="mb-4">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled>
        </div>

        <!-- Email Field -->
        <div class="mb-4">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <!-- Additional Fields (if any) -->
        @if($user->phone)
        <div class="mb-4">
          <label for="phone" class="form-label">Nomor Telepon</label>
          <input type="text" id="phone" class="form-control" value="{{ $user->phone }}" disabled>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
          <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Profil
          </a>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Profile Section -->
@endsection

@section('styles')
<style>
  .profile .breadcrumb {
    background: transparent;
    padding: 0;
  }
  .profile .breadcrumb-item.active {
    color: #2c4964;
    font-weight: 600;
  }
  
  .profile .profile-card {
    border: none;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  }
  
  .profile .profile-card .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #eee;
    padding: 1.5rem;
  }
  
  .profile .profile-card .card-header h4 {
    color: #2c4964;
    margin-bottom: 0;
  }
  
  .profile .profile-card .card-body {
    padding: 2rem;
  }
  
  .profile .form-label {
    font-weight: 500;
    color: #495057;
  }
  
  .profile .form-control:disabled {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
  }
  
  .profile .btn-primary {
    background-color: #2c4964;
    border-color: #2c4964;
    padding: 0.5rem 1.5rem;
  }
  
  .profile .btn-primary:hover {
    background-color: #1a2f4d;
    border-color: #1a2f4d;
  }
  
  .profile .btn-outline-secondary {
    padding: 0.5rem 1.5rem;
  }
</style>
@endsection