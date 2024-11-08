@extends('layouts.master')

@section('title', 'Edit Jenis Layanan')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jenis_layanan.index') }}">Jenis Layanan</a></li>
    <li class="active">Edit Jenis Layanan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Edit Jenis Layanan</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jenis_layanan.update', $jenisLayanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Layanan -->
                    <div class="mb-3">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" value="{{ $jenisLayanan->nama_layanan }}" required>
                    </div>

                    <!-- Paket Layanan -->
                    <div class="mb-3">
                        <label for="paket_layanan" class="form-label">Paket Layanan</label>
                        <input type="text" class="form-control" name="paket_layanan" id="paket_layanan" value="{{ $jenisLayanan->paket_layanan }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" value="{{ formatRupiah($layanan->harga) }}" required>

                    </div>

                    <!-- Tombol Update dan Batal -->
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('jenis_layanan.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
