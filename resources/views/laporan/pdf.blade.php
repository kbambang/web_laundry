<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
        }
        h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>


    <table class="table">
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Konsumen</th>
                <th>Jenis Layanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->no_transaksi }}</td>
                    <td>{{ $order->konsumen->nama }}</td>
                
                    <td>{{ $order->jenisLayanan->nama_layanan }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->jenisPembayaran->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>

</body>
</html>
