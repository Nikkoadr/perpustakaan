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
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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

                <li class="nav-item">
                    <a href="/admin/data_buku" class="nav-link {{ request()->is('admin/data_buku*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Data Buku</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/admin/kategori" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Buku</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/pengguna*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Manajemen Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/pengguna/petugas" class="nav-link {{ request()->is('admin/pengguna/petugas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Petugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/pengguna/anggota" class="nav-link {{ request()->is('admin/pengguna/anggota') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/admin/peminjaman" class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Data Peminjaman</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/laporan*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/laporan/peminjaman" class="nav-link {{ request()->is('admin/laporan/peminjaman') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Dipinjam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/laporan/pengembalian" class="nav-link {{ request()->is('admin/laporan/pengembalian') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Dikembalikan</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
