<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>
    <h2>Tambah Barang</h2>

    <form action="/barang/store" method="post">
        <label>Kode Barang</label><br>
        <input type="text" name="kode_barang" required><br><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama_barang" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>