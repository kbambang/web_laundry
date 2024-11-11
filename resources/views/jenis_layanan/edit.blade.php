@extends('layouts.master')
<!-- Menggunakan layout master yang sudah ada sebagai dasar untuk halaman ini -->

@section('title', 'Edit Jenis Layanan')
<!-- Menetapkan judul halaman yang akan ditampilkan pada bagian <title> di layout master -->

@section('breadcrumb')
    <!-- Bagian breadcrumb untuk menampilkan jalur navigasi halaman ini -->
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <!-- Menu Home yang mengarah ke halaman utama -->
    <li><a href="{{ route('jenis_layanan.index') }}">Jenis Layanan</a></li>
    <!-- Menu Jenis Layanan yang mengarah ke halaman daftar jenis layanan -->
    <li class="active">Edit Jenis Layanan</li>
    <!-- Teks aktif yang menunjukkan halaman saat ini adalah Edit Jenis Layanan -->
@endsection

@section('content')
    <!-- Bagian konten utama halaman -->
    <div class="container-fluid">
        <!-- Container utama dengan kelas container-fluid untuk desain responsif -->
        <h1>Edit Jenis Layanan</h1>
        <!-- Judul Halaman -->

        <div class="card">
            <!-- Membuat kartu (card) untuk menampilkan form -->
            <div class="card-body">
                <!-- Bagian tubuh dari kartu -->
                <form action="{{ route('jenis_layanan.update', $jenisLayanan->id) }}" method="POST">
                    <!-- Formulir untuk mengupdate data jenis layanan, mengirimkan data ke rute update dengan ID jenis layanan -->
                    @csrf
                    <!-- Token CSRF untuk keamanan -->
                    @method('PUT')
                    <!-- Menyatakan bahwa ini adalah permintaan untuk melakukan pembaruan data -->

                    <!-- Input untuk Nama Layanan -->
                    <div class="mb-3">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <!-- Label untuk input Nama Layanan -->
                        <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" value="{{ $jenisLayanan->nama_layanan }}" required>
                        <!-- Input field untuk Nama Layanan, dengan nilai yang sudah diisi dengan data lama (untuk edit) -->
                    </div>

                    <!-- Input untuk Paket Layanan -->
                    <div class="mb-3">
                        <label for="paket_layanan" class="form-label">Paket Layanan</label>
                        <!-- Label untuk input Paket Layanan -->
                        <input type="text" class="form-control" name="paket_layanan" id="paket_layanan" value="{{ $jenisLayanan->paket_layanan }}" required>
                        <!-- Input field untuk Paket Layanan, dengan nilai yang sudah diisi dengan data lama (untuk edit) -->
                    </div>

                    <!-- Input untuk Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <!-- Label untuk input Harga -->
                        <input type="text" class="form-control" name="harga" id="harga" value="{{ str_replace(['Rp ', '.'], '', formatRupiah($jenisLayanan->harga)) }}" required>
                        <!-- Input field untuk Harga, nilai diubah dari format Rupiah menjadi nilai murni (tanpa 'Rp' dan titik) dengan str_replace -->
                    </div>

                    <!-- Tombol Update dan Batal -->
                    <button type="submit" class="btn btn-warning">Update</button>
                    <!-- Tombol untuk menyimpan perubahan, dengan label "Update" dan kelas btn-warning -->
                    <a href="{{ route('jenis_layanan.index') }}" class="btn btn-secondary">Batal</a>
                    <!-- Tombol untuk membatalkan dan kembali ke halaman daftar jenis layanan, dengan kelas btn-secondary -->
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Bagian untuk menambahkan skrip tambahan di halaman ini -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menunggu hingga seluruh halaman selesai dimuat sebelum menjalankan skrip
        const hargaInput = document.getElementById('harga');
        // Menyimpan elemen input harga ke dalam variabel hargaInput

        // Saat field harga difokuskan, hapus "Rp " dan titik
        hargaInput.addEventListener('focus', function () {
            hargaInput.value = hargaInput.value.replace(/[Rp\s.]/g, '');
            // Menghapus semua simbol "Rp ", spasi, dan titik ketika input difokuskan
        });

        // Saat field harga kehilangan fokus, tambahkan format "Rp " kembali jika perlu
        hargaInput.addEventListener('blur', function () {
            const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(hargaInput.value);
            // Menggunakan Intl.NumberFormat untuk memformat nilai sebagai Rupiah setelah kehilangan fokus
            hargaInput.value = formatted.replace("Rp", "Rp ");
            // Mengganti "Rp" yang ada dengan "Rp " untuk memastikan format yang tepat
        });
    });
</script>
@endsection
<!-- Akhir dari section skrip -->
