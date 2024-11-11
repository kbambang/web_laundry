<?php

// Mendeklarasikan namespace untuk AdminController ini di dalam App\Http\Controllers
namespace App\Http\Controllers;

// Mengimpor kelas Request dari Illuminate\Http, yang digunakan untuk mengelola data permintaan HTTP
use Illuminate\Http\Request;

// Mengimpor kelas Auth dari Illuminate\Support\Facades, yang digunakan untuk autentikasi pengguna
use Illuminate\Support\Facades\Auth;

// Mendefinisikan kelas AdminController yang merupakan bagian dari Controller utama di Laravel
class AdminController extends Controller
{
    // Mendefinisikan metode index yang akan diakses ketika fungsi ini dipanggil
    function index() {
        // Mengembalikan tampilan (view) bernama "dashboard.index" ketika metode ini dipanggil
        return view("dashboard.index");
    }

    // Mendefinisikan metode admin yang juga mengembalikan view "dashboard.index"
    function admin() {
        // Mengembalikan tampilan yang sama seperti index
        return view("dashboard.index");
    }

    // Mendefinisikan metode petugas, dengan mengembalikan view yang sama seperti metode lain
    function petugas() {
        return view("dashboard.index");
    }

    // Mendefinisikan metode pimpinan, yang juga mengembalikan view "dashboard.index"
    function pimpinan() {
        return view("dashboard.index");
    }
}
