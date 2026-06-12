<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard Minimarket</h2>

    <p>Selamat datang, <?= session()->get('nama'); ?></p>

    <ul>
        <li><a href="/barang">Data Barang</a></li>
        <li><a href="/transaksi">Transaksi</a></li>
        <li><a href="/laporan">Laporan</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</body>
</html>