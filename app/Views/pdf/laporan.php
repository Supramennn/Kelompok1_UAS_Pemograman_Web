<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background-color: #eee;
        }

        .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Minimarket</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
        </tr>

        <?php 
        $no = 1; 
        $grandTotal = 0;
        foreach ($transaksi as $row) : 
            $grandTotal += $row['total'];
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_transaksi']; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td class="right">Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
            <td class="right">Rp <?= number_format($row['bayar'], 0, ',', '.'); ?></td>
            <td class="right">Rp <?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>

        <tr>
            <th colspan="3">Grand Total</th>
            <th colspan="3" class="right">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></th>
        </tr>
    </table>
</body>
</html>