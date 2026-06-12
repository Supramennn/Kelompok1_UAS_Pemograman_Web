<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .nota {
            width: 100%;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .header p {
            margin: 4px 0;
            font-size: 12px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 2px 0;
        }

        table.detail {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.detail th {
            border-bottom: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        table.detail td {
            border-bottom: 1px solid #ddd;
            padding: 6px;
        }

        .right {
            text-align: right;
        }

        .summary {
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="nota">

    <div class="header">
        <h2>Madura Mart</h2>
        <p>Jl. Mulu capek kali</p>
        <p>Telp: 0813 kamu cinta aku engga</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Kode Transaksi</td>
                <td>: <?= $transaksi['kode_transaksi']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= $transaksi['tanggal']; ?></td>
            </tr>
        </table>
    </div>

    <table class="detail">
        <tr>
            <th>Barang</th>
            <th class="right">Harga</th>
            <th class="right">Qty</th>
            <th class="right">Subtotal</th>
        </tr>

        <?php foreach ($detail as $row) : ?>
        <tr>
            <td><?= $row['nama_barang']; ?></td>
            <td class="right">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td class="right"><?= $row['qty']; ?></td>
            <td class="right">Rp <?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <table class="summary">
        <tr>
            <td>Total</td>
            <td class="right">Rp <?= number_format($transaksi['total'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="right">Rp <?= number_format($transaksi['bayar'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="right">Rp <?= number_format($transaksi['kembalian'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih sudah berbelanja.</p>
        <p>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
    </div>

</div>

</body>
</html>