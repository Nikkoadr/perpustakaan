@extends('layouts.master')
@section('title', 'Laporan Peminjaman')
@section('link')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Peminjaman</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Filter -->
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('laporan.index') }}" method="GET" class="form-inline">
                        <div class="form-group mr-3">
                            <label class="mr-2">Jenis Laporan:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="filter" id="filterHarian" value="harian" {{ request('filter') == 'harian' ? 'checked' : '' }}>
                                <label class="form-check-label" for="filterHarian">Harian</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="filter" id="filterBulanan" value="bulanan" {{ request('filter') == 'bulanan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="filterBulanan">Bulanan</label>
                            </div>
                        </div>
                    
                        <div class="form-group mr-2" id="tanggalField">
                            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        </div>
                    
                        <div class="form-group mr-2" id="bulanField">
                            <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                        </div>
                    
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
                    </form>
                    
                </div>
                <div class="card-body">
                    <table id="laporanTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->buku->judul }}</td>
                                    <td>{{ $item->tanggal_pinjam }}</td>
                                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->status == 'dipinjam' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $('#laporanTable').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>
<script>
    function toggleFilterFields() {
        const filter = $('input[name="filter"]:checked').val();
        if (filter === 'harian') {
            $('#tanggalField').show();
            $('#bulanField').hide();
        } else if (filter === 'bulanan') {
            $('#tanggalField').hide();
            $('#bulanField').show();
        } else {
            $('#tanggalField').hide();
            $('#bulanField').hide();
        }
    }

    $(document).ready(function() {
        toggleFilterFields();
        $('input[name="filter"]').change(toggleFilterFields);
    });
</script>

@endsection
