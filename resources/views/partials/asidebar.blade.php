<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->foto && file_exists(public_path('storage/foto/' . Auth::user()->foto)))
                    <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('assets/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="Default User Image">
                @endif
            </div>
            <div class="info">
                <a href="/admin/profile" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        

        <!-- Menu Sidebar -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('data_buku.index') }}" class="nav-link {{ request()->is('admin/data_buku*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Data Buku</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Kategori Buku</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pengguna.index') }}" class="nav-link {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                    @endcan
                    @can('admin-dan-petugas')
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>Data Peminjaman</p>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
