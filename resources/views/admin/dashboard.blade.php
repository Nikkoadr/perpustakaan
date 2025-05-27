@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info Boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- Buku -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jumlah_buku }}</h3>
                            <p>Total Buku</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="/admin/buku" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Anggota -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jumlah_anggota }}</h3>
                            <p>Total Anggota</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="/admin/pengguna/anggota" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Peminjaman Aktif -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $peminjaman_aktif }}</h3>
                            <p>Peminjaman Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <a href="/admin/peminjaman" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Pengembalian -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $peminjaman_selesai }}</h3>
                            <p>Pengembalian Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <a href="/admin/laporan/pengembalian" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Welcome Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah halaman utama admin. Anda dapat mengelola data buku, peminjaman, pengembalian, dan pengguna sistem perpustakaan.</p>
                    <p>Gunakan menu di sebelah kiri untuk mengakses fitur yang tersedia.</p>
                    <p>Jika Anda membutuhkan bantuan, silakan hubungi pengembang.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
