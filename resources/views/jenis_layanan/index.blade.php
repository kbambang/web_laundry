@extends('layouts.master')
<!-- Menggunakan layout master yang sudah ada sebagai dasar untuk halaman ini -->

@section('title', 'Data Jenis Layanan')
<!-- Menetapkan judul halaman yang akan ditampilkan pada bagian <title> di layout master -->

@section('breadcrumb')
    <!-- Bagian breadcrumb, menunjukkan jalur navigasi untuk halaman ini -->
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <!-- Menu Home yang mengarah ke halaman utama -->
    <li class="active">Data Jenis Layanan</li>
    <!-- Menampilkan teks aktif untuk halaman Data Jenis Layanan -->
@endsection

@section('content')
    <!-- Bagian konten halaman -->
    <div class="container-fluid">
        <!-- Container utama dengan kelas container-fluid untuk desain responsif -->

        <!-- Tombol untuk menambah data jenis layanan -->
        <a href="{{ route('jenis_layanan.create') }}" class="btn btn-success mb-3">Tambah Jenis Layanan</a>
        <!-- Tombol yang mengarahkan ke halaman form untuk menambahkan jenis layanan baru -->

        <!-- Menampilkan pesan sukses jika ada session success -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Jika ada session 'success', maka menampilkan pesan sukses -->

        <!-- Membuat tabel untuk menampilkan data jenis layanan -->
        <div class="table-responsive">
            <!-- Membuat tabel yang responsif, sehingga bisa digulir pada layar kecil -->
            <table class="table table-bordered table-striped">
                <!-- Tabel dengan kelas-kelas Bootstrap untuk penataan -->
                <thead class="table-light">
                    <!-- Bagian header tabel dengan kelas table-light untuk memberi warna latar terang -->
                    <tr>
                        <!-- Kolom tabel -->
                        <th scope="col">ID</th>
                        <!-- Kolom untuk ID jenis layanan -->
                        <th scope="col">Nama Layanan</th>
                        <!-- Kolom untuk Nama Layanan -->
                        <th scope="col">Paket Layanan</th>
                        <!-- Kolom untuk Paket Layanan -->
                        <th scope="col">Harga</th>
                        <!-- Kolom untuk Harga jenis layanan -->
                        <th scope="col" class="text-center">Aksi</th>
                        <!-- Kolom untuk aksi (Edit, Hapus) dengan alignment tengah -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Bagian tubuh tabel untuk menampilkan data -->
                    @foreach ($jenisLayanan as $layanan)
                        <!-- Looping data jenis layanan yang didapatkan dari controller -->
                        <tr>
                            <!-- Baris tabel -->
                            <td>{{ $layanan->id }}</td>
                            <!-- Menampilkan ID jenis layanan -->
                            <td>{{ $layanan->nama_layanan }}</td>
                            <!-- Menampilkan Nama Layanan -->
                            <td>{{ $layanan->paket_layanan }}</td>
                            <!-- Menampilkan Paket Layanan -->
                            <td>{{ formatRupiah($layanan->harga) }}</td>
                            <!-- Menampilkan Harga jenis layanan, menggunakan fungsi formatRupiah untuk format uang -->

                            <td class="text-center">
                                <!-- Kolom aksi dengan alignment tengah -->
                                <a href="{{ route('jenis_layanan.edit', $layanan->id) }}" class="btn btn-primary btn-sm me-1">
                                    <!-- Tombol untuk edit, mengarahkan ke halaman edit untuk jenis layanan -->
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('jenis_layanan.destroy', $layanan->id) }}" method="POST" style="display:inline;">
                                    <!-- Formulir untuk menghapus jenis layanan, menggunakan metode POST dengan method spoofing -->
                                    @csrf
                                    <!-- Token CSRF untuk keamanan -->
                                    @method('DELETE')
                                    <!-- Menyatakan bahwa ini adalah permintaan untuk menghapus data -->
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jenis pembayaran ini?')">
                                        <!-- Tombol hapus dengan konfirmasi sebelum penghapusan -->
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                            <!-- Tombol aksi untuk Edit dan Hapus -->
                        </tr>
                    @endforeach
                    <!-- End of looping -->
                </tbody>
            </table>
        </div>
        <!-- Akhir dari tabel -->
    </div>
    <!-- Akhir dari container-fluid -->
@endsection
<!-- Akhir dari section konten -->
