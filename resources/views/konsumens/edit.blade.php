@extends('layouts.master')

@section('title', 'Edit Konsumen')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('konsumens.index') }}">Data Konsumen</a></li>
    <li class="active">Edit Konsumen</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Edit Konsumen</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('konsumens.update', $konsumen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $konsumen->nama }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $konsumen->email }}" required>
                    </div>

                    <!-- No HP -->
                    <div class="form-group mb-3">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $konsumen->no_hp }}" required>
                    </div>

                    <!-- Tombol Update -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('konsumens.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
