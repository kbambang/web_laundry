@extends('layouts.master')

@section('title', 'Dashboard ')

@section('breadcrumb')
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        

        <!-- Ringkasan Data -->
       <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
              {{-- <h3>{{ $totalKonsumen }}</h3> --}}
  
                <p>Total konsumen</p>
              </div> 
              <div class="icon">
                {{-- <i class="fa fa-cube"></i> --}}
              </div>
              <a href="{{ route('konsumens.index') }}" class="small-box-footer">lihat <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
       </div>
       <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                {{-- <h3>{{ $totalJenisLayanan }}</h3> --}}
  
                <p>Total Layanan</p>
              </div>
              <div class="icon">
                {{-- <i class="fa fa-cube"></i> --}}
              </div>
              <a href="{{ route('konsumens.index') }}" class="small-box-footer">lihat <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
       </div>
       <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                {{-- <h3>{{ $totalJenisPembayaran   }}</h3> --}}
  
                <p>Total Pembayaran</p>
              </div>
              <div class="icon">
                {{-- <i class="fa fa-cube"></i> --}}
              </div>
              <a href="{{ route('konsumens.index') }}" class="small-box-footer">lihat <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
       </div>
       <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                {{-- <h3>{{ $totalOfficers }}</h3> --}}
  
                <p>Total Petugas</p>
              </div>
              <div class="icon">
                {{-- <i class="fa fa-cube"></i> --}}
              </div>
              <a href="{{ route('konsumens.index') }}" class="small-box-footer">lihat <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
       </div>
       
          

        <!-- Grafik Transaksi Bulanan -->
         
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
