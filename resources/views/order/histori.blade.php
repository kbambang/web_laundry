@extends('layouts.master')

@section('title', 'Histori Order')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Histori Order</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Judul Halaman -->
        <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan No Transaksi..." class="form-control d-inline-block w-auto">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
        
      

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Tabel Data Order -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th>No Transaksi</th>
                        <th scope="col">Konsumen</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Jenis Layanan</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->no_transaksi }}</td>
                            <td>{{ $order->konsumen->nama }}</td>
                            <td>{{ $order->jenisLayanan->nama_layanan }}</td>
                            <td>{{ $order->jenisPembayaran->nama_pembayaran }}</td>
                            <td>{{ $order->jumlah }}</td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                @if ($order->status === 'completed')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-warning">Belum Selesai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($order->status === 'pending')
                                    <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
