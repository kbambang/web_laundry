<!-- resources/views/officers/index.blade.php -->
@extends('layouts.master')

@section('title', 'Data Officers')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Officers</li>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Tombol Tambah Officer -->
        <a href="{{ route('officers.create') }}" class="btn btn-success mb-3">Tambah Officer</a>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel Data Officers -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Email</th>
                        <th scope="col">No HP</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($officers as $officer)
                        <tr>
                            <td>{{ $officer->nama }}</td>
                            <td>{{ $officer->position }}</td>
                            <td>{{ $officer->email }}</td>
                            <td>{{ $officer->phone }}</td>
                            <td class="text-center">
                                <a href="{{ route('officers.edit', $officer->id) }}" class="btn btn-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('officers.destroy', $officer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus officer ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection