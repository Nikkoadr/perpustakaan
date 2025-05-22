@extends('layouts.master')
@section('title', 'Tambah Data')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Data</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('example.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Data String</label>
                    <input type="text" name="data_string" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Data Integer</label>
                    <input type="number" name="data_int" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Data Text</label>
                    <textarea name="data_text" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('example.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</div>
@endsection
