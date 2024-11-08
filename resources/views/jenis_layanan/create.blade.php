@extends('layouts.master')

@section('title', 'Tambah Jenis Layanan')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jenis_layanan.index') }}">Jenis Layanan</a></li>
    <li class="active">Tambah Jenis Layanan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Tambah Jenis Layanan</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jenis_layanan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_layanan">Nama Layanan</label>
                        <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paket_layanan">Paket Layanan</label>
                        <input type="text" name="paket_layanan" id="paket_layanan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
