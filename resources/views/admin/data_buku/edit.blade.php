@extends('layouts.master')
@section('title', 'Edit Data Buku')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Data Buku</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('data_buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" class="form-control @error('judul') is-invalid @enderror">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}" class="form-control @error('penulis') is-invalid @enderror">
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="form-control @error('penerbit') is-invalid @enderror">
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="form-control @error('tahun_terbit') is-invalid @enderror">
                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar_sampul">Gambar Sampul</label>
                    @if ($buku->gambar_sampul)
                        <div class="mb-2">
                            <img src="{{ asset('storage/sampul/' . $buku->gambar_sampul) }}" width="80" alt="Sampul Lama">
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="gambar_sampul" class="custom-file-input @error('gambar_sampul') is-invalid @enderror" id="gambar_sampul">
                            <label class="custom-file-label" for="gambar_sampul">Pilih file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('gambar_sampul')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="form-control @error('stok') is-invalid @enderror">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('data_buku.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection
