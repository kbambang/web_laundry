@extends('layouts.master')

@section('title', 'Data Orders')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Data Order</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Tombol Tambah Order -->
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-4">Tambah Order</a>

        <!-- Form Pencarian -->
        <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan No Transaksi..." class="form-control d-inline-block w-auto">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
        

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel Data Orders -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th>No Transaksi</th>
                        <th>Konsumen</th>
                        <th>Petugas</th>
                        <th>Jenis Layanan</th>
                        <th>Jenis Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->no_transaksi }}</td>
                            <td>{{ $order->konsumen->nama }}</td>
                           
                            <td>{{ optional($order->jenisLayanan)->nama_layanan ?? 'Tidak tersedia' }}</td>
                            <td>{{ $order->jenisPembayaran->nama_pembayaran }}</td>
                            <td>{{ $order->jumlah }}</td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td><span class="badge {{ $order->status == 'selesai' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->status) }}</span></td>
                            <td>
                                <!-- Tombol Aksi (Hapus) -->
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus order ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada hasil yang ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
