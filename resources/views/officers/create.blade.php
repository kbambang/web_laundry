<!-- resources/views/officers/create.blade.php -->
@extends('layouts.master')

@section('title', 'Add New Officer')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('officers.index') }}">Data Officers</a></li>
    <li class="active">Add New Officer</li>
@endsection

@section('content')
    <div class="container-fluid">
        <h2>Add New Officer</h2>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Officer -->
        <form action="{{ route('officers.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <!-- Tombol Simpan dan Kembali -->
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('officers.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
@endsection
