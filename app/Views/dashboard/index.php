<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Madura Mart</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
            background:
                linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(34, 197, 94, 0.08)),
                #f4f7fb;
        }

        .page {
            width: min(1080px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-weight: 700;
            background: #0f766e;
            box-shadow: 0 10px 24px rgba(15, 118, 110, 0.22);
        }

        h1 {
            margin: 0;
            font-size: clamp(24px, 4vw, 34px);
            line-height: 1.15;
            letter-spacing: 0;
        }

        .subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .logout {
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            color: #334155;
            background: #ffffff;
            text-decoration: none;
            font-weight: 700;
        }

        .welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px;
            margin-bottom: 22px;
            border: 1px solid #dbe4ef;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        }

        .welcome strong {
            display: block;
            margin-bottom: 4px;
            font-size: 18px;
        }

        .welcome span {
            color: #64748b;
            font-size: 14px;
        }

        .role-badge {
            padding: 8px 12px;
            border-radius: 999px;
            color: #0f766e;
            background: #ccfbf1;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .alert {
            margin: 0 0 18px;
            padding: 12px 14px;
            border-left: 4px solid #dc2626;
            border-radius: 8px;
            color: #991b1b;
            background: #fef2f2;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .menu-card {
            min-height: 158px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            border: 1px solid #dbe4ef;
            border-radius: 8px;
            color: #172033;
            background: #ffffff;
            text-decoration: none;
            box-shadow: 0 14px 36px rgba(15, 23, 42, 0.07);
            transition: transform 160ms ease, box-shadow 160ms ease, border-color 160ms ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            border-color: #0ea5e9;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.12);
        }

        .card-kicker {
            width: fit-content;
            padding: 6px 10px;
            border-radius: 999px;
            color: #0369a1;
            background: #e0f2fe;
            font-size: 12px;
            font-weight: 700;
        }

        .menu-card:nth-child(2) .card-kicker {
            color: #15803d;
            background: #dcfce7;
        }

        .menu-card:nth-child(3) .card-kicker {
            color: #b45309;
            background: #fef3c7;
        }

        .menu-title {
            margin: 16px 0 8px;
            font-size: 22px;
            font-weight: 800;
        }

        .menu-meta {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        .menu-action {
            margin-top: 22px;
            color: #0f766e;
            font-weight: 800;
        }

        @media (max-width: 640px) {
            .page {
                width: min(100% - 24px, 1080px);
                padding: 20px 0;
            }

            .topbar,
            .welcome {
                align-items: flex-start;
                flex-direction: column;
            }

            .logout {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<?php
    $role = session()->get('role');
    $isAdmin = $role === 'admin';
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    $tanggalHariIni = date('d') . ' ' . $bulan[(int) date('n')] . ' ' . date('Y');
?>

<main class="page">
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Dashboard Madura Mart</h1>
                <p class="subtitle"><?= $tanggalHariIni; ?></p>
            </div>
        </div>
        <a class="logout" href="/logout">Logout</a>
    </header>

    <?php if (session()->getFlashdata('error')) : ?>
        <p class="alert"><?= esc(session()->getFlashdata('error')); ?></p>
    <?php endif; ?>

    <section class="welcome">
        <div>
            <strong>Selamat datang, <?= esc(session()->get('nama')); ?></strong>
            <span>Sistem Penjualan Madura Mart</span>
        </div>
        <div class="role-badge"><?= esc($role); ?></div>
    </section>

    <nav class="menu-grid" aria-label="Menu dashboard">
        <a class="menu-card" href="/barang">
            <div>
                <div class="card-kicker">Data</div>
                <div class="menu-title">Data Barang</div>
                <div class="menu-meta">Stok, harga, ketersediaan</div>
            </div>
            <div class="menu-action">Buka</div>
        </a>

        <a class="menu-card" href="/transaksi">
            <div>
                <div class="card-kicker">Kasir</div>
                <div class="menu-title">Transaksi</div>
                <div class="menu-meta">Penjualan harian</div>
            </div>
            <div class="menu-action">Buka</div>
        </a>

        <?php if ($isAdmin) : ?>
            <a class="menu-card" href="/laporan">
                <div>
                    <div class="card-kicker">Rekap</div>
                    <div class="menu-title">Laporan</div>
                    <div class="menu-meta">Riwayat transaksi</div>
                </div>
                <div class="menu-action">Buka</div>
            </a>
        <?php endif; ?>
    </nav>
</main>
</body>
</html>
