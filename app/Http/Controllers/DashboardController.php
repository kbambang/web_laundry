<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Konsumen;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data
        $totalKonsumen = Konsumen::count();
        $totalJenisLayanan = JenisLayanan::count();
        $totalPendapatan = Order::where('status', 'completed')->sum('total_harga');
        $totalOrder = Order::count();

        // Mengambil data untuk grafik transaksi bulanan
        $transaksiBulanan = Order::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Isi nilai kosong untuk bulan yang belum ada transaksi
        $transaksiBulanan = array_replace(array_fill(1, 12, 0), $transaksiBulanan);

        return view('dashboard.index', compact(
            'totalKonsumen',

            'totalJenisLayanan',
            'totalPendapatan',
            'totalOrder',
            'transaksiBulanan'
        ));
    }
}
