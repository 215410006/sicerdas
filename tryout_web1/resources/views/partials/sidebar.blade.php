<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">SiCERDAS</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">EP</a>
    </div>
    <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>

      {{-- Untuk Admin --}}
      @auth
          @if(auth()->user()->role === 'admin')
              <li>
                  <a class="nav-link" href="{{ route('admin.dashboard_admin') }}">
                      <i class="fas fa-home"></i> <span>Dashboard Admin</span>
                  </a>
              </li>
          @elseif(auth()->user()->role === 'staff')
              <li>
                  <a class="nav-link" href="{{ route('staff.dashboard_staff') }}">
                      <i class="fas fa-home"></i> <span>Dashboard Staff</span>
                  </a>
              </li>
          @elseif(auth()->user()->role === 'student')
              <li>
                  <a class="nav-link" href="{{ route('students.dashboard_student') }}">
                      <i class="fas fa-home"></i> <span>Dashboard Siswa</span>
                  </a>
              </li>
          @endif
      @endauth

      @auth
       <!-- Untuk admin atau role lain -->
        @if(auth()->user()->role !== 'student')
            <li class="menu-header">Pengelolaan Konten</li>

            <!-- Manajemen Soal -->
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>Manajemen Soal</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('questions.create') }}">Tambah Soal Baru</a></li>
                <li><a class="nav-link" href="{{ route('questions.index') }}">Daftar Soal</a></li>
                <li><a class="nav-link" href="{{ route('question_categories.index') }}">Kategori Soal</a></li>
              </ul>
            </li>

            <!-- Manajemen Materi (khusus admin) -->
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i> <span>Manajemen Materi</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('materi.create') }}">Unggah Materi</a></li>
                <li><a class="nav-link" href="{{ route('materi.index') }}">Daftar Materi</a></li>
                <li><a class="nav-link" href="{{ route('materi_kategori.index') }}">Kategori Materi</a></li>
              </ul>
            </li>
          @endif

          <!-- Untuk semua user, termasuk student -->
          <li class="menu-header">Materi Pembelajaran</li>
          <li>
            <a class="nav-link" href="{{ route('materi.index') }}">
              <i class="fas fa-book-reader"></i> <span>Materi</span>
            </a>
          </li>

        <!-- Manajemen Tryout -->
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Manajemen Tryout</span></a>
          <ul class="dropdown-menu">
            @if(auth()->user()->role !== 'student')
              <li><a class="nav-link" href="{{ route('tryout.create') }}">Buat Tryout</a></li>
            @endif
            <li><a class="nav-link" href="{{ route('tryout.index') }}">Daftar Tryout</a></li>
            <li><a class="nav-link" href="{{ route('tryout.schedule') }}">Jadwal Tryout</a></li>
            <li><a class="nav-link" href="{{ route('tryout.result') }}">Hasil Tryout</a></li>
          </ul>
        </li>

        <!-- Leaderboard -->
        <li><a class="nav-link" href="{{ route('tryout.leaderboard') }}"><i class="fas fa-trophy"></i> <span>Leaderboard</span></a></li>

        @if(auth()->user()->role === 'admin')
          <!-- Manajemen Pengguna -->
          <li class="menu-header">Manajemen Pengguna</li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Pengguna</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('students.index') }}">Daftar Siswa</a></li>
              <li><a class="nav-link" href="{{ route('staff.index') }}">Daftar Staff</a></li>
              <li><a class="nav-link" href="{{ route('students.create') }}">Tambah Pengguna</a></li>
              <li><a class="nav-link" href="{{ route('staff.index') }}">Pengaturan Peran</a></li>
            </ul>
          </li>

          <!-- Monitoring -->
          <li class="menu-header">Monitoring</li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i> <span>Performa Siswa</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('performa.laporan-skor') }}">Laporan Skor</a></li>
              <li><a class="nav-link" href="{{ route('performa.kemajuan') }}">Kemajuan Siswa</a></li>
              <li><a class="nav-link" href="{{ route('performa.kehadiran') }}">Kehadiran</a></li>
            </ul>
          </li>

          <!-- Pengaturan -->
          <li class="menu-header">Pengaturan</li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('pengaturan.umum') }}">Umum</a></li>
              <li><a class="nav-link" href="{{ route('pengaturan.keamanan') }}">Keamanan</a></li>
            </ul>
          </li>
        @endif

        <!-- Profil -->
        <li><a class="nav-link" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> <span>Profil</span></a></li>


        <!-- Bantuan -->
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-question-circle"></i> Bantuan
          </a>
        </div>
      @endauth
    </ul>
  </aside>
</div>
