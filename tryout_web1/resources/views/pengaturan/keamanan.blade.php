@extends('layouts.app')

@section('title', 'Pengaturan Keamanan')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Pengaturan Keamanan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Pengaturan Keamanan</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Kelola Keamanan Akun Anda</h2>
      <p class="section-lead">
        Ubah pengaturan keamanan akun Anda di halaman ini.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Pengaturan Keamanan</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-4">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">Ubah Password</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="2fa-tab" data-toggle="tab" href="#twofa" role="tab" aria-controls="twofa" aria-selected="false">Two-Factor Authentication</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sessions-tab" data-toggle="tab" href="#sessions" role="tab" aria-controls="sessions" aria-selected="false">Sesi Aktif</a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                  <div class="tab-content no-padding" id="myTab2Content">
                    <div class="tab-pane fade show active" id="password" role="tabpanel" aria-labelledby="password-tab">
                      <form method="POST" action="#">
                        @csrf
                        <div class="form-group">
                          <label>Password Saat Ini</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="current_password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Password Baru</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="new_password">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Konfirmasi Password Baru</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="confirm_password">
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Simpan Perubahan
                          </button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="twofa" role="tabpanel" aria-labelledby="2fa-tab">
                      <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Two-factor authentication menambah lapisan keamanan ekstra ke akun Anda.
                      </div>
                      <div class="form-group">
                        <label class="custom-switch mt-2">
                          <input type="checkbox" name="2fa_enabled" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Aktifkan Two-Factor Authentication</span>
                        </label>
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-primary">
                          <i class="fas fa-cog"></i> Konfigurasi
                        </button>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Perangkat</th>
                              <th>IP Address</th>
                              <th>Terakhir Aktif</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Windows 10, Chrome</td>
                              <td>192.168.1.1</td>
                              <td>2 menit yang lalu</td>
                              <td><a href="#" class="btn btn-danger btn-sm">Keluar</a></td>
                            </tr>
                            <tr>
                              <td>Android, Firefox</td>
                              <td>192.168.1.2</td>
                              <td>1 jam yang lalu</td>
                              <td><a href="#" class="btn btn-danger btn-sm">Keluar</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bg-whitesmoke">
              <i class="fas fa-shield-alt"></i> Keamanan adalah prioritas kami
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('scripts')
<!-- JS Libraries -->
<script src="{{ asset('stisla/node_modules/jquery-ui-dist/jquery-ui.min.js') }}"></script>
@endsection