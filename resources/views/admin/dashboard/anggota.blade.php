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
                    <h1>Dashboard Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Anggota</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Buku Sedang Dipinjam -->
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pinjam_aktif->count() }}</h3>
                            <p>Buku Sedang Dipinjam</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                    </div>
                </div>

                <!-- Buku Pernah Dipinjam -->
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $riwayat->count() }}</h3>
                            <p>Riwayat Peminjaman</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-history"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Welcome -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Halo, {{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah dashboard anggota. Anda dapat melihat status peminjaman dan riwayat pengembalian buku Anda.</p>
                    <p>Pastikan untuk mengembalikan buku tepat waktu agar tidak terkena denda keterlambatan.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
