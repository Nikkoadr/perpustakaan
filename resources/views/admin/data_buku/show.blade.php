@extends('layouts.master')
@section('title', 'Detail Data')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Detail Data</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Data String</dt>
                        <dd class="col-sm-9">{{ $example->data_string }}</dd>

                        <dt class="col-sm-3">Data Integer</dt>
                        <dd class="col-sm-9">{{ $example->data_int }}</dd>

                        <dt class="col-sm-3">Data Text</dt>
                        <dd class="col-sm-9">{{ $example->data_text }}</dd>

                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($example->date)->format('d M Y') }}</dd>
                    </dl>
                    <a href="{{ route('example.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
