@extends('layouts.master')

@section('content')
    <h1>Tambah Jenis Pembayaran</h1>
    <form action="{{ route('jenis_pembayaran.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
            <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
