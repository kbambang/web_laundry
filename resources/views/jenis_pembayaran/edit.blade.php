@extends('layouts.master')

@section('content')
    <h1>Edit Jenis Pembayaran</h1>
    <form action="{{ route('jenis_pembayaran.update', $jenisPembayaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
            <input type="text" class="form-control" name="nama_pembayaran" id="nama_pembayaran" value="{{ $jenisPembayaran->nama_pembayaran }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection
