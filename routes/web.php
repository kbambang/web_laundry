<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\OfficerController;

Route::resource('officers', OfficerController::class);



Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.exportPdf');


// Menampilkan dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Menampilkan laporan transaksi
Route::get('laporan/transaksi', [LaporanController::class, 'index'])->name('laporan.transaksi')->middleware('userAkses:admin');
Route::get('laporan/transaksi/export', [LaporanController::class, 'export'])->name('laporan.transaksi.export')->middleware('userAkses:admin');

// Orders
Route::resource('orders', OrderController::class)->middleware('userAkses:admin,petugas');
Route::get('order/histori', [OrderController::class, 'histori'])->name('orders.histori');
Route::post('order/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

// Jenis Pembayaran dan Layanan
Route::resource('jenis_pembayaran', JenisPembayaranController::class)->middleware('userAkses:admin');

Route::resource('jenis_layanan', JenisLayananController::class)->middleware('userAkses:admin');

// Konsumen dan Petugas
Route::resource('konsumens', KonsumenController::class)->middleware('userAkses:admin,petugas');

// Route untuk pengguna tamu (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get("/", [SesiController::class, 'index'])->name('login');
    Route::post("/", [SesiController::class, 'login']);
});

// Route untuk home redirect
Route::get('/home', function () {
    return redirect('/admin');
});

// Route dengan autentikasi dan akses peran
Route::middleware(['auth'])->group(function() {
    Route::get("/admin", [AdminController::class, "index"]);
    Route::get("/admin/admin", [AdminController::class, "admin"])->middleware('userAkses:admin');
    Route::get("/admin/petugas", [AdminController::class, "petugas"])->middleware('userAkses:petugas');
    Route::get("/admin/pimpinan", [AdminController::class, "pimpinan"])->middleware('userAkses:pimpinan');


    // Route::get('/petugas', [AdminController::class,'admin'])->middleware('userAkses:admin');

    Route::get('/logout', [SesiController::class, 'logout']);
});
