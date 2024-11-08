@extends('layouts.master')

@section('title', 'Laporan Transaksi')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan Transaksi</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Judul Halaman -->
       
        
        <!-- Filter Tanggal (Opsional) -->
        <form method="GET" action="{{ route('laporan.transaksi') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request()->start_date }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request()->end_date }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th>Konsumen</th>
                        {{-- <th>Petugas</th> --}}
                        {{-- <th>Jenis Layanan</th> --}}
                        {{-- <th>Jenis Pembayaran</th> --}}
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        {{-- <th>Status</th> --}}
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->konsumen->nama }}</td>
                            {{-- <td>{{ $order->officer->nama }}</td> --}}
                            {{-- <td>{{ $order->jenisLayanan->nama_layanan }}</td> --}}
                            {{-- <td>{{ $order->jenisPembayaran->nama_pembayaran }}</td> --}}
                            <td>{{ $order->jumlah }}</td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            {{-- <td><span class="badge {{ $order->status == 'selesai' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->status) }}</span></td> --}}
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>

        <!-- Export Laporan (Opsional) -->
        <div class="mt-4">
            <a href="{{ route('laporan.exportPdf') }}" class="btn btn-danger">Export to PDF</a>
        </div>
    </div>
@endsection
