<!-- resources/views/landing.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
    /* public/css/style.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
}

header {
    text-align: center;
    padding: 100px;
    background-color: #4CAF50;
    color: #fff;
}

.btn-primary {
    padding: 10px 20px;
    color: #fff;
    background-color: #FF6347;
    text-decoration: none;
    border-radius: 5px;
}

section {
    padding: 50px;
    text-align: center;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: #fff;
}

</style>
<body>
    <header>
        <h1>Selamat Datang di Laundry Kami!</h1>
        <p>Solusi terbaik untuk kebutuhan laundry Anda.</p>
        <a href="#services" class="btn-primary">Lihat Layanan Kami</a>
    </header>

    <section id="services">
        <h2>Layanan Kami</h2>
        <ul>
            <li>Cuci Kering</li>
            <li>Cuci Setrika</li>
            <li>Setrika Saja</li>
            <li>Antar Jemput</li>
        </ul>
    </section>

    <section id="contact">
        <h2>Hubungi Kami</h2>
        <p>Hubungi kami di: (123) 456-7890</p>
        <p>Email: info@laundry.com</p>
    </section>

    <footer>
        <p>&copy; 2024 Laundry Kami. All rights reserved.</p>
    </footer>
</body>
</html>
