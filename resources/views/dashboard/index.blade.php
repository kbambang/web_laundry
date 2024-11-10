@extends('layouts.master')

@section('title', 'Dashboard ')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard {{  Auth::user()->name }}</li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        

        <!-- Ringkasan Data -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Konsumen</h5> 
                        {{-- <p class="card-text display-6">{{ $totalKonsumen }}</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">Total Petugas</h5> 
                        {{-- <p class="card-text display-6">{{ $totalPetugas }}</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Total Layanan</h5>
                        {{-- <p class="card-text display-6">{{ $totalJenisLayanan }}</p> --}}
                     </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Total Pendapatan</h5> 
                        {{-- <p class="card-text display-6">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p> --}}
                     </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card shadow-sm border-0 text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title text-info">Total Order</h5> 
                         {{-- <p class="card-text display-6">{{ $totalOrder }}</p>  --}}
                     </div>
                </div>
            </div>
        </div> 

        <!-- Grafik Transaksi Bulanan -->
         <div class="mt-5">
            <h2 class="mb-4 text-center">Transaksi Bulanan</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <canvas id="transaksiChart" style="height:400px;"></canvas>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah Transaksi',
           
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script> 
@endsection
