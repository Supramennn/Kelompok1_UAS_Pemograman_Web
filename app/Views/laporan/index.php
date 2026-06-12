<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<?php
    $grandTotal = 0;
    foreach ($transaksi as $row) {
        $grandTotal += $row['total'];
    }
?>

<main class="page">
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Laporan Transaksi</h1>
                <p class="subtitle">Rekap transaksi penjualan</p>
            </div>
        </div>
        <div class="actions">
            <a class="btn" href="/dashboard">Dashboard</a>
            <a class="btn btn-primary" href="/laporan/pdf" target="_blank">Cetak PDF</a>
        </div>
    </header>

    <section class="stats-grid">
        <div class="stat-box">
            <span>Jumlah Transaksi</span>
            <strong><?= count($transaksi); ?></strong>
        </div>
        <div class="stat-box">
            <span>Total Penjualan</span>
            <strong>Rp <?= number_format($grandTotal, 0, ',', '.'); ?></strong>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h2>Riwayat Transaksi</h2>
            <p class="subtitle">Data diurutkan dari transaksi terbaru.</p>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th class="right">Total</th>
                        <th class="right">Bayar</th>
                        <th class="right">Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transaksi)) : ?>
                        <tr>
                            <td class="empty-state" colspan="6">Belum ada transaksi.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($transaksi as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($row['kode_transaksi']); ?></td>
                                <td><?= esc($row['tanggal']); ?></td>
                                <td class="right">Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                                <td class="right">Rp <?= number_format($row['bayar'], 0, ',', '.'); ?></td>
                                <td class="right">Rp <?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
