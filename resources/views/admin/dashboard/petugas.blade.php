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
                    <h1>Dashboard Petugas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Petugas</a></li>
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
                <!-- Peminjaman Aktif -->
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $peminjaman_aktif }}</h3>
                            <p>Peminjaman Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <a href="/petugas/peminjaman" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

            <!-- Welcome -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang, {{ Auth::user()->name }}</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah dashboard petugas. Anda dapat memantau peminjaman dan pengembalian hari ini.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
