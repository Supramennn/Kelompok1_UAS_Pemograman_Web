<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>
    <h2>Edit Barang</h2>

    <form action="/barang/update/<?= $barang['id']; ?>" method="post">
        <label>Kode Barang</label><br>
        <input type="text" name="kode_barang" value="<?= $barang['kode_barang']; ?>" required><br><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama_barang" value="<?= $barang['nama_barang']; ?>" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" value="<?= $barang['harga']; ?>" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" value="<?= $barang['stok']; ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>