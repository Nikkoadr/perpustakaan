@extends('layouts.master')
@section('title', 'Edit Data')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Data</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('example.update', $example->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Data String</label>
                    <input type="text" name="data_string" value="{{ $example->data_string }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Data Integer</label>
                    <input type="number" name="data_int" value="{{ $example->data_int }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Data Text</label>
                    <textarea name="data_text" class="form-control" rows="4" required>{{ $example->data_text }}</textarea>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" value="{{ $example->date }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('example.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </section>
</div>
@endsection
