<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 24px;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            background: #ffffff;
        }

        .report {
            width: 100%;
            border: 1px solid #d9e2ec;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            padding: 18px 20px;
            color: #ffffff;
            background: #0f766e;
        }

        .header-table,
        .summary-table,
        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            text-align: center;
            vertical-align: middle;
            color: #0f766e;
            background: #ffffff;
            font-size: 18px;
            font-weight: bold;
        }

        .brand-copy {
            padding-left: 12px;
        }

        .brand-copy h1 {
            margin: 0 0 4px;
            font-size: 24px;
            letter-spacing: 0;
        }

        .brand-copy p,
        .report-title p {
            margin: 2px 0;
            color: #d9fffb;
        }

        .report-title {
            text-align: right;
            vertical-align: top;
        }

        .report-title h2 {
            margin: 0 0 6px;
            font-size: 14px;
            letter-spacing: 0;
        }

        .content {
            padding: 18px 20px 20px;
        }

        .summary-table {
            margin-bottom: 16px;
        }

        .summary-table td {
            width: 33.33%;
            padding: 12px;
            border: 1px solid #dbe4ef;
            background: #f8fafc;
        }

        .summary-table span {
            display: block;
            margin-bottom: 5px;
            color: #64748b;
            font-size: 10px;
            font-weight: bold;
        }

        .summary-table strong {
            color: #0f766e;
            font-size: 15px;
        }

        .detail-table {
            table-layout: fixed;
        }

        .detail-table th {
            padding: 9px 8px;
            color: #ffffff;
            background: #334155;
            font-size: 10px;
            text-align: left;
        }

        .detail-table td {
            padding: 9px 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .detail-table tr:nth-child(even) td {
            background: #f8fafc;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .grand-row td {
            border-bottom: 0;
            color: #ffffff;
            background: #0f766e;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
    $grandTotal = 0;
    foreach ($transaksi as $row) {
        $grandTotal += $row['total'];
    }
    $tanggalCetak = date('d/m/Y H:i');
?>

<div class="report">
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="brand-mark">MM</td>
                <td class="brand-copy">
                       <h1>Madura Mart</h1>
                    <p>Jl. Mulu Capek Kali</p>
                    <p>Telp: 0819-kapan-kapan-kita-liburan</p>
                </td>
                <td class="report-title">
                    <h2>LAPORAN TRANSAKSI</h2>
                    <p>Dicetak: <?= esc($tanggalCetak); ?></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <table class="summary-table">
            <tr>
                <td>
                    <span>Jumlah Transaksi</span>
                    <strong><?= count($transaksi); ?></strong>
                </td>
                <td>
                    <span>Total Penjualan</span>
                    <strong>Rp <?= number_format($grandTotal, 0, ',', '.'); ?></strong>
                </td>
                <td>
                    <span>Status</span>
                    <strong>Final</strong>
                </td>
            </tr>
        </table>

        <table class="detail-table">
            <tr>
                <th class="center" width="34">No</th>
                <th>Kode Transaksi</th>
                <th width="118">Tanggal</th>
                <th class="right">Total</th>
                <th class="right">Bayar</th>
                <th class="right">Kembalian</th>
            </tr>

            <?php if (empty($transaksi)) : ?>
                <tr>
                    <td class="center" colspan="6">Belum ada transaksi.</td>
                </tr>
            <?php else : ?>
                <?php $no = 1; foreach ($transaksi as $row) : ?>
                    <tr>
                        <td class="center"><?= $no++; ?></td>
                        <td><?= esc($row['kode_transaksi']); ?></td>
                        <td><?= esc($row['tanggal']); ?></td>
                        <td class="right">Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td class="right">Rp <?= number_format($row['bayar'], 0, ',', '.'); ?></td>
                        <td class="right">Rp <?= number_format($row['kembalian'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <tr class="grand-row">
                <td colspan="3">Grand Total</td>
                <td class="right" colspan="3">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
