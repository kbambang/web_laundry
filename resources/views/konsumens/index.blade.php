@extends('layouts.master')

@section('title', 'Data Konsumen')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Konsumen</li>
@endsection

@section('content')
    <div class="container-fluid">


        <!-- Tombol Tambah Konsumen -->
        <a href="{{ route('konsumens.create') }}" class="btn btn-success mb-3">Tambah Konsumen</a>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel Data Konsumen -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No HP</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsumens as $konsumen)
                        <tr>
                            <td>{{ $konsumen->nama }}</td>
                            <td>{{ $konsumen->email }}</td>
                            <td>{{ $konsumen->no_hp }}</td>
                            <td class="text-center">
                                <a href="{{ route('konsumens.edit', $konsumen->id) }}" class="btn btn-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('konsumens.destroy', $konsumen->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus konsumen ini?')">
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
