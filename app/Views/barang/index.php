<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<?php $isAdmin = session()->get('role') === 'admin'; ?>

<main class="page">
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Data Barang</h1>
                <p class="subtitle"><?= $isAdmin ? 'Kelola stok dan harga barang' : 'Lihat stok dan harga barang'; ?></p>
            </div>
        </div>
        <div class="actions">
            <a class="btn" href="/dashboard">Dashboard</a>
            <a class="btn" href="/logout">Logout</a>
        </div>
    </header>

    <?php if (session()->getFlashdata('error')) : ?>
        <p class="alert"><?= esc(session()->getFlashdata('error')); ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <p class="alert alert-success"><?= esc(session()->getFlashdata('success')); ?></p>
    <?php endif; ?>

    <section class="panel">
        <div class="panel-header toolbar">
            <div>
                <h2>Daftar Barang</h2>
                <p class="subtitle">Total data: <?= count($barang); ?> barang</p>
            </div>
            <?php if ($isAdmin) : ?>
                <a class="btn btn-primary" href="/barang/create">Tambah Barang</a>
            <?php endif; ?>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th class="right">Harga</th>
                        <th class="center">Stok</th>
                        <?php if ($isAdmin) : ?>
                            <th class="center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($barang)) : ?>
                        <tr>
                            <td class="empty-state" colspan="<?= $isAdmin ? 6 : 5; ?>">Belum ada data barang.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($barang as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($row['kode_barang']); ?></td>
                                <td><?= esc($row['nama_barang']); ?></td>
                                <td class="right">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td class="center"><?= esc($row['stok']); ?></td>
                                <?php if ($isAdmin) : ?>
                                    <td class="center">
                                        <a class="btn btn-small" href="/barang/edit/<?= $row['id']; ?>">Edit</a>
                                        <a class="btn btn-small btn-danger" href="/barang/delete/<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                    </td>
                                <?php endif; ?>
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
