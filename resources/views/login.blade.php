<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            justify-content: space-between;
            padding: 50px 100px
        }

        .sreach{
          
        }
        .login-container {
            max-width: 350px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h1 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #446DB2;
            margin-bottom: 20px;
        }
        .form-control {
            background-color: #f1f1f1;
            border: none;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .form-check-label, .forgot-link {
            font-size: 0.9rem;
        }
        .forgot-link {
            color: #446DB2;
            text-decoration: none;
            float: right;
        }
        .forgot-link:hover {
            text-decoration: underline;
        }
        .btn-primary {
            background-color: #446DB2;
            border: none;
            padding: 10px 0;
            font-size: 1rem;
            border-radius: 4px;
        }
        .btn-primary:hover {
            background-color: #446DB2;
        }
    </style>
</head>
<body>
     <div class="sreach">
          <!-- Form Pencarian -->
          <h1>Cari pesanan anda disini </h1>
          <form action="{{ route('login') }}" method="GET" class="mt-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan No Transaksi..." class="form-control d-inline-block w-auto">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
<!-- Tampilkan Hasil Pencarian -->
@if(isset($orders) && count($orders) > 0)

<h3 class="mt-4">Hasil Pencarian:</h3>
<ul class="list-group mt-3">
    @foreach ($orders as $order)
        <li class="list-group-item">
nama : {{ $order->konsumen->nama }}, Total harga : Rp {{ number_format($order->total_harga, 0, ',', '.') }}, jumlah : <td>{{ $order->jumlah }}</td>, status : <td><span class="badge {{ $order->status == 'selesai' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->status) }}</span></td>
        </li>
    @endforeach
</ul>
@elseif(request('search'))
<p class="mt-3">Tidak ada hasil yang ditemukan untuk pencarian "{{ request('search') }}".</p>
@endif
     </div>
    <div class="login-container">
       
        <h1>LOGIN</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>
            <button name="submit" type="submit" class="btn btn-primary w-100">LOGIN</button>
        </form>

       

       
    </div> 
</body>
</html>
