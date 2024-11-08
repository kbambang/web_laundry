@extends('layouts.master')

@section('title', 'Data Jenis Layanan')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Jenis Layanan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Judul Halaman -->
        

        <!-- Tombol Tambah Data -->
        <a href="{{ route('jenis_layanan.create') }}" class="btn btn-success mb-3">Tambah Jenis Layanan</a>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel Data Jenis Layanan -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Layanan</th>
                        <th scope="col">Paket Layanan</th>
                        <th scope="col">Harga</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisLayanan as $layanan)
                        <tr>
                            <td>{{ $layanan->id }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ $layanan->paket_layanan }}</td>
                            <td>{{ formatRupiah($layanan->harga) }}</td>

                            <td class="text-center">
                                <a href="{{ route('jenis_layanan.edit', $layanan->id) }}" class="btn btn-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('jenis_layanan.destroy', $layanan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jenis pembayaran ini?')">
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
