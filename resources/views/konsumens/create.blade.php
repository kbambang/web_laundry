@extends('layouts.master')

@section('title', 'Tambah Konsumen')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('konsumens.index') }}">Data Konsumen</a></li>
    <li class="active">Tambah Konsumen</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Tambah Konsumen</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('konsumens.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp" required>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('konsumens.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
