@extends('layouts.master')

@section('content')
    <h1>Tambah Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="konsumen_id" class="form-label">Konsumen</label>
            <select class="form-control" name="konsumen_id" id="konsumen_id" required>
                @foreach($konsumens as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="officer_id" class="form-label">Petugas</label>
            <select class="form-control" name="officer_id" id="officer_id" required>
                @foreach($officers as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jenis_pembayaran_id" class="form-label">Jenis Pembayaran</label>
            <select class="form-control" name="jenis_pembayaran_id" id="jenis_pembayaran_id" required>
                @foreach($jenisPembayaran as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_pembayaran }}</option>
                @endforeach
            </select>
        </div>
        <label for="jenis_layanan">Jenis Layanan:</label>
        <select name="jenis_layanan_id" id="jenis_layanan" required>
            @foreach ($jenisLayanan as $layanan)
                <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}">
                    {{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
        
        <br>
        
        <label for="jumlah">Jumlah (kg):</label>
        <select name="jumlah" id="jumlah" required>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }} kg</option>
            @endfor
        </select>
        
        <br>
        
        <label for="total_harga">Total Harga:</label>
        <input type="text" id="total_harga_display" class="form-control" disabled> <!-- Menampilkan total harga dengan format mata uang -->
        <input type="hidden" name="total_harga" id="total_harga"> <!-- Total harga dalam angka akan disimpan disini -->
    
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlah = document.getElementById('jumlah');
        const jenisLayanan = document.getElementById('jenis_layanan');
        const totalHargaDisplay = document.getElementById('total_harga_display');
        const totalHargaInput = document.getElementById('total_harga');
        const hargaPerKg = 10000; // Harga per kilogram

        // Fungsi untuk menghitung total harga
        function updateTotalHarga() {
            const selectedJumlah = parseInt(jumlah.value); // Mengambil jumlah kg
            const layananHarga = parseInt(jenisLayanan.options[jenisLayanan.selectedIndex].getAttribute('data-harga')); // Mengambil harga jenis layanan
            const calculatedTotal = (selectedJumlah * hargaPerKg) + layananHarga; // Perhitungan total harga

            // Update nilai input tersembunyi
            totalHargaInput.value = calculatedTotal;

            // Update tampilan total harga dengan format mata uang
            totalHargaDisplay.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(calculatedTotal);
        }

        // Hitung total harga saat jumlah atau jenis layanan berubah
        jumlah.addEventListener('change', updateTotalHarga);
        jenisLayanan.addEventListener('change', updateTotalHarga);

        // Hitung total harga saat halaman dimuat
        updateTotalHarga();
    });
</script>
