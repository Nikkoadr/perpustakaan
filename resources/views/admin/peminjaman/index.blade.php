@extends('layouts.master')
@section('title', 'Data Peminjaman')
@section('link')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item">Database</li>
                        <li class="breadcrumb-item active">Peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="card-title text-white">Tambah Peminjaman</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="nama_pengguna" placeholder="Ketik nama pengguna..." value="{{ old('nama_pengguna') }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}">
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control @error('buku_id') is-invalid @enderror" id="judul_buku" placeholder="Ketik judul buku..." value="{{ old('judul_buku') }}">
                            <input type="hidden" name="buku_id" id="buku_id" value="{{ old('buku_id') }}">
                            @error('buku_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" readonly>
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>Jatuh Tempo</label>
                            <input type="date" name="tanggal_jatuh_tempo" class="form-control @error('tanggal_jatuh_tempo') is-invalid @enderror" value="{{ old('tanggal_jatuh_tempo', \Carbon\Carbon::now()->addDays(7)->format('Y-m-d')) }}">
                            @error('tanggal_jatuh_tempo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman Aktif</h3>
            </div>
            <div class="card-body">
                <table id="peminjamanTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamanAktif as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->user->name }}</td>
                            <td>{{ $peminjaman->buku->judul }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_jatuh_tempo }}</td>
                            <td>
                                @if (\Carbon\Carbon::now()->gt($peminjaman->tanggal_jatuh_tempo))
                                    <span class="badge badge-danger">Terlambat</span>
                                @else
                                    <span class="badge badge-success">Dipinjam</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('peminjaman.perpanjang', $peminjaman->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-redo"></i> Perpanjang
                                </a>
                                <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-undo"></i> Kembalikan
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("#peminjamanTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#peminjamanTable_wrapper .col-md-6:eq(0)');
    });
</script>
@if (session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>
@endif
@if ($errors->any())
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Terjadi kesalahan validasi!',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>
@endif
<script>
$(function () {
    $("#nama_pengguna").autocomplete({
        source: '/autocomplete/pengguna',
        minLength: 2,
        select: function (event, ui) {
            $('#nama_pengguna').val(ui.item.label);
            $('#user_id').val(ui.item.id);
            return false;
        }
    });

    $("#judul_buku").autocomplete({
        source: '/autocomplete/buku',
        minLength: 2,
        select: function (event, ui) {
            $('#judul_buku').val(ui.item.label);
            $('#buku_id').val(ui.item.id);
            return false;
        }
    });
});
</script>

@endsection
