@extends('layouts.app')

@section('title', 'Pengaturan Umum — UTBK Learning')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengaturan Umum</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard_admin') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Pengaturan Umum</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-cog"></i> Konfigurasi Sistem</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" id="btn-save-settings">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="settings-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Aplikasi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="app_name" value="UTBK Learning">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo Aplikasi</label>
                                <div class="col-sm-9">
                                    <div id="image-preview" class="image-preview" style="background-image: url('{{ asset('stisla/img/logo.png') }}'); background-size: cover;">
                                        <label for="image-upload" id="image-label">Pilih File</label>
                                        <input type="file" name="logo" id="image-upload" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Zona Waktu</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="timezone">
                                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Warna Tema</label>
                                <div class="col-sm-9">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="theme_color" value="primary" checked> Biru
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" name="theme_color" value="danger"> Merah
                                        </label>
                                        <label class="btn btn-success">
                                            <input type="radio" name="theme_color" value="success"> Hijau
                                        </label>
                                        <label class="btn btn-warning">
                                            <input type="radio" name="theme_color" value="warning"> Kuning
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pemeliharaan Sistem</label>
                                <div class="col-sm-9">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="maintenance_mode" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Mode Pemeliharaan</span>
                                    </label>
                                    <small class="form-text text-muted">
                                        Aktifkan untuk menghentikan sementara akses pengguna ke sistem
                                    </small>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-whitesmoke text-right">
                        <button class="btn btn-primary" id="btn-save-settings-footer">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <button class="btn btn-secondary" id="btn-reset-settings">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
<style>
    .image-preview {
        width: 200px;
        height: 200px;
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        border: 2px dashed #6777ef;
        margin-bottom: 10px;
    }
    
    .image-preview #image-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #6777ef;
        font-weight: bold;
        cursor: pointer;
        z-index: 10;
    }
    
    .image-preview #image-upload {
        display: none;
    }
    
    .image-preview:hover {
        background-color: #f0f0f0;
    }
    
    .custom-switch-description {
        margin-left: 10px;
    }
    
    .card-footer {
        border-top: 1px solid #f0f0f0;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize select2
        $('.select2').select2();
        
        // Image preview handler
        $('#image-upload').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').css('background-image', 'url(' + e.target.result + ')');
                    $('#image-label').hide();
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Save button handler
        $('#btn-save-settings, #btn-save-settings-footer').click(function() {
            const formData = new FormData($('#settings-form')[0]);
            
            // Show loading
            $(this).addClass('btn-progress').prop('disabled', true);
            
            // Simulate AJAX call
            setTimeout(function() {
                // Hide loading
                $('.btn-progress').removeClass('btn-progress').prop('disabled', false);
                
                // Show success message
                iziToast.success({
                    title: 'Berhasil!',
                    message: 'Pengaturan berhasil disimpan',
                    position: 'topRight'
                });
            }, 1500);
        });
        
        // Reset button handler
        $('#btn-reset-settings').click(function() {
            $('#settings-form')[0].reset();
            $('#image-preview').css('background-image', 'url("{{ asset('stisla/img/logo.png') }}")');
            $('#image-label').show();
            $('.select2').val('Asia/Jakarta').trigger('change');
        });
    });
</script>
@endpush