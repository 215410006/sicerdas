<nav class="navbar navbar-expand-lg main-navbar">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Sidebar Toggle & Search -->
    <div class="d-flex align-items-center">
      <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg me-2">
        <i class="fas fa-bars"></i>
      </a>
      <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
        <i class="fas fa-search"></i>
      </a>
    </div>

    <!-- Search Bar (Desktop Only) -->
    <form class="d-none d-md-flex align-items-center" method="GET" action="#">
      <input class="form-control form-control-sm" type="search" placeholder="Cari menu atau tenant..." style="max-width: 220px;">
      <button class="btn btn-sm btn-primary ms-2" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </form>

    <!-- User Profile Dropdown -->
    <ul class="navbar-nav navbar-right">
      @auth
        <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle d-flex align-items-center">
            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle me-2" width="30" height="30">
            <span class="d-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
              <i class="far fa-user"></i> Profil Saya
            </a>
            <a href="#" class="dropdown-item has-icon">
              <i class="fas fa-cog"></i> Pengaturan Akun
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
        </li>
      @endauth
    </ul>
  </div>
</nav>
