<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 6pt;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 7.4pt;
            line-height: 1.18;
            color: #111827;
            background: #ffffff;
        }

        .receipt {
            width: 100%;
        }

        .store {
            padding: 0 0 4pt;
            border-bottom: 1pt solid #0f766e;
            text-align: center;
        }

        .store h1 {
            margin: 0 0 2pt;
            color: #0f766e;
            font-size: 12pt;
            letter-spacing: 0;
        }

        .store p {
            margin: 1pt 0;
            color: #475569;
            font-size: 6.6pt;
        }

        .title {
            margin: 4pt 0 3pt;
            padding: 2pt 0;
            color: #ffffff;
            background: #0f766e;
            text-align: center;
            font-size: 7.6pt;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta td {
            padding: 1pt 0;
            vertical-align: top;
        }

        .meta-label {
            width: 38pt;
            color: #64748b;
        }

        .meta-value {
            font-weight: bold;
        }

        .separator {
            margin: 4pt 0;
            border-top: 1pt dashed #94a3b8;
        }

        .items th {
            padding: 2pt 0;
            border-bottom: 1pt solid #334155;
            color: #334155;
            font-size: 6.6pt;
            text-align: left;
        }

        .items td {
            padding: 1.6pt 0;
            vertical-align: top;
        }

        .item-name {
            padding-top: 3pt;
            font-weight: bold;
        }

        .item-calc {
            color: #64748b;
            font-size: 6.7pt;
        }

        .right {
            text-align: right;
        }

        .summary {
            margin-top: 3pt;
        }

        .summary td {
            padding: 1.8pt 0;
        }

        .summary .label {
            color: #475569;
        }

        .summary .grand td {
            padding: 3pt 4pt;
            color: #ffffff;
            background: #0f766e;
            font-size: 8pt;
            font-weight: bold;
        }

        .footer {
            margin-top: 5pt;
            padding-top: 4pt;
            border-top: 1pt dashed #94a3b8;
            color: #475569;
            text-align: center;
            font-size: 6.5pt;
        }
    </style>
</head>
<body>
<?php
    $tanggal = ! empty($transaksi['tanggal']) ? date('d/m/Y H:i', strtotime($transaksi['tanggal'])) : '-';
    $namaKasir = $transaksi['nama_kasir'] ?? '-';
?>

<div class="receipt">
    <div class="store">
        <h1>Madura Mart</h1>
        <p>Jl. Mulu Capek Kali</p>
        <p>Telp: 0819-kapan-kapan-kita-liburan</p>
    </div>

    <div class="title">NOTA PENJUALAN</div>

    <table class="meta">
        <tr>
            <td class="meta-label">No</td>
            <td class="meta-value">: <?= esc($transaksi['kode_transaksi']); ?></td>
        </tr>
        <tr>
            <td class="meta-label">Tanggal</td>
            <td class="meta-value">: <?= esc($tanggal); ?></td>
        </tr>
        <tr>
            <td class="meta-label">Kasir</td>
            <td class="meta-value">: <?= esc($namaKasir); ?></td>
        </tr>
    </table>

    <div class="separator"></div>

    <table class="items">
        <tr>
            <th>Barang</th>
            <th class="right">Subtotal</th>
        </tr>

        <?php foreach ($detail as $row) : ?>
            <tr>
                <td class="item-name" colspan="2"><?= esc($row['nama_barang']); ?></td>
            </tr>
            <tr>
                <td class="item-calc"><?= esc($row['qty']); ?> x Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td class="right">Rp <?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="separator"></div>

    <table class="summary">
        <tr>
            <td class="label">Total</td>
            <td class="right">Rp <?= number_format($transaksi['total'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td class="label">Bayar</td>
            <td class="right">Rp <?= number_format($transaksi['bayar'], 0, ',', '.'); ?></td>
        </tr>
        <tr class="grand">
            <td>Kembali</td>
            <td class="right">Rp <?= number_format($transaksi['kembalian'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="footer">
        Terima kasih sudah berbelanja.<br>
        Barang yang sudah dibeli tidak dapat dikembalikan.
    </div>
</div>
</body>
</html>
