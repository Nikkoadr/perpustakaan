@extends('layouts.master')
@section('title', 'Tambah Data Buku')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Data Buku</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="/admin/data_buku" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gambar Sampul</label>
                    <input type="file" name="gambar_sampul" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required min="0">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/admin/data_buku" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</div>
@endsection
