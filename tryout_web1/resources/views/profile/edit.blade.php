@extends('layouts.app')

@section('title', 'Edit Profil — EduPrep')

@section('content')
<!-- ======= Edit Profile Section ======= -->
<section id="edit-profile" class="edit-profile">
  <div class="container" data-aos="fade-up">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
      </ol>
    </nav>

    <div class="section-title">
      <h2>Edit Profil</h2>
      <p>Perbarui informasi profil dan akun Anda</p>
    </div>

    <div class="card profile-card">
      <div class="card-header">
        <h4>Profil Pengguna</h4>
      </div>
      <div class="card-body">
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Nama -->
          <div class="mb-4">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" 
                  class="form-control @error('name') is-invalid @enderror" 
                  value="{{ old('name', $user->name) }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Email -->
          <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  value="{{ old('email', $user->email) }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" 
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Kosongkan jika tidak ingin mengubah">
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                  class="form-control" 
                  placeholder="Konfirmasi password baru">
          </div>

          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary me-md-2">
              Batal
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-save"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</section><!-- End Edit Profile Section -->
@endsection

@section('styles')
<style>
  .edit-profile .breadcrumb {
    background: transparent;
    padding: 0;
  }
  .edit-profile .breadcrumb-item.active {
    color: #2c4964;
    font-weight: 600;
  }
  
  .edit-profile .profile-card {
    border: none;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
  }
  
  .edit-profile .profile-card .card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #eee;
    padding: 1.5rem;
  }
  
  .edit-profile .profile-card .card-header h4 {
    color: #2c4964;
    margin-bottom: 0;
  }
  
  .edit-profile .profile-card .card-body {
    padding: 2rem;
  }
  
  .edit-profile .form-label {
    font-weight: 500;
    color: #495057;
  }
  
  .edit-profile .form-control {
    padding: 0.75rem 1rem;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
  }
  
  .edit-profile .form-control:focus {
    border-color: #2c4964;
    box-shadow: 0 0 0 0.25rem rgba(44, 73, 100, 0.25);
  }
  
  .edit-profile .btn-primary {
    background-color: #2c4964;
    border-color: #2c4964;
    padding: 0.5rem 1.5rem;
  }
  
  .edit-profile .btn-primary:hover {
    background-color: #1a2f4d;
    border-color: #1a2f4d;
  }
  
  .edit-profile .btn-outline-secondary {
    padding: 0.5rem 1.5rem;
  }
</style>
@endsection