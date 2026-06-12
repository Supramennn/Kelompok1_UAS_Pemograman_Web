<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<main class="page page-narrow">
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Tambah Barang</h1>
                <p class="subtitle">Input data barang baru</p>
            </div>
        </div>
        <div class="actions">
            <a class="btn" href="/barang">Data Barang</a>
            <a class="btn" href="/dashboard">Dashboard</a>
        </div>
    </header>

    <section class="panel">
        <div class="panel-header">
            <h2>Form Barang</h2>
            <p class="subtitle">Lengkapi kode, nama, harga, dan stok.</p>
        </div>

        <div class="panel-body">
            <form class="form-grid" action="/barang/store" method="post">
                <div class="form-field">
                    <label for="kode_barang">Kode Barang</label>
                    <input id="kode_barang" type="text" name="kode_barang" required>
                </div>

                <div class="form-field">
                    <label for="nama_barang">Nama Barang</label>
                    <input id="nama_barang" type="text" name="nama_barang" required>
                </div>

                <div class="form-field">
                    <label for="harga">Harga</label>
                    <input id="harga" type="number" name="harga" min="0" required>
                </div>

                <div class="form-field">
                    <label for="stok">Stok</label>
                    <input id="stok" type="number" name="stok" min="0" required>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a class="btn" href="/barang">Batal</a>
                </div>
            </form>
        </div>
    </section>
</main>
</body>
</html>
