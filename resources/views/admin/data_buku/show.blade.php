@extends('layouts.master')
@section('title', 'Detail Buku')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item">Database</li>
                        <li class="breadcrumb-item active">Buku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('data_buku.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($buku->gambar_sampul)
                                <img src="{{ asset('storage/sampul/' . $buku->gambar_sampul) }}" class="img-fluid" alt="Sampul Buku">
                            @else
                                <p class="text-muted">Tidak ada gambar sampul</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $buku->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penulis</th>
                                        <td>{{ $buku->penulis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penerbit</th>
                                        <td>{{ $buku->penerbit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Terbit</th>
                                        <td>{{ $buku->tahun_terbit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>{{ $buku->stok }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{ $buku->kategori->nama ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
