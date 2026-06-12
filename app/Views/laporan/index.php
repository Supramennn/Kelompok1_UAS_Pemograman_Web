<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
</head>
<body>
    <h2>Laporan Transaksi</h2>

    <a href="/dashboard">Dashboard</a> |
    <a href="/laporan/pdf" target="_blank">Cetak PDF</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
        </tr>

        <?php $no = 1; foreach ($transaksi as $row) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_transaksi']; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($row['bayar'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>