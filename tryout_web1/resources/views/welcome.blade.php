<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Belajar UTBK Online — SiCERDAS</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #2c4964;
        }
        
        .hero-section {
            background-color: #2c4964;
            color: white;
            padding: 5rem 0;
        }
        
        .feature-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #2c4964;
            margin-bottom: 1rem;
        }
        
        .btn-primary {
            background-color: #2c4964;
            border-color: #2c4964;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-primary:hover {
            background-color: #1a2f4d;
            border-color: #1a2f4d;
        }
        
        .btn-outline-light:hover {
            color: #2c4964;
        }
        
        footer {
            background-color: #2c4964;
            color: white;
            padding: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">SiCERDAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Persiapan UTBK Lebih Mudah!</h1>
            <p class="lead mb-5">Akses ribuan soal, materi, dan latihan tryout UTBK secara online.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-person-plus"></i> Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Kenapa Pilih SiCERDAS?</h2>
                <p class="text-muted">Solusi lengkap persiapan UTBK Anda</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-collection"></i>
                            </div>
                            <h4 class="card-title">Soal Lengkap</h4>
                            <p class="card-text text-muted">Akses ribuan soal UTBK dari berbagai tahun dengan pembahasan lengkap dan mudah dipahami.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <h4 class="card-title">Materi Lengkap</h4>
                            <p class="card-text text-muted">Belajar dengan video pembelajaran, modul teks, dan latihan soal interaktif yang terstruktur.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <h4 class="card-title">Tryout & Analisis</h4>
                            <p class="card-text text-muted">Latihan tryout dengan hasil analisis skor, pembahasan, dan peringkat nasional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Apa Kata Mereka?</h2>
                <p class="text-muted">Testimoni dari pengguna SiCERDAS</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle me-3" width="50" alt="User">
                                <div>
                                    <h5 class="mb-0">Sarah Putri</h5>
                                    <small class="text-muted">Siswa SMA</small>
                                </div>
                            </div>
                            <p class="card-text">"Dengan SiCERDAS, saya bisa belajar kapan saja dan di mana saja. Soal-soalnya sangat membantu persiapan UTBK saya."</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" class="rounded-circle me-3" width="50" alt="User">
                                <div>
                                    <h5 class="mb-0">Budi Santoso</h5>
                                    <small class="text-muted">Siswa SMA</small>
                                </div>
                            </div>
                            <p class="card-text">"Tryout di SiCERDAS sangat mirip dengan UTBK asli. Analisis hasilnya membantu saya mengetahui kelemahan saya."</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" width="50" alt="User">
                                <div>
                                    <h5 class="mb-0">Dewi Anggraeni</h5>
                                    <small class="text-muted">Orang Tua</small>
                                </div>
                            </div>
                            <p class="card-text">"Anak saya menjadi lebih termotivasi belajar sejak menggunakan SiCERDAS. Materinya sangat terstruktur dan mudah dipahami."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Siap Memulai Persiapan Untuk Menuju Generasi Emas?</h2>
            <p class="lead mb-5">Bergabunglah dengan Kami untuk membentuk Generasi Emas bersama SiCERDAS</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                <i class="bi bi-person-plus"></i> Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">© {{ date('Y') }} SiCERDAS. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>