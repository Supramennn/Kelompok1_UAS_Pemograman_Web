<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Penjualan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        input, select {
            width: 100%;
            padding: 7px;
            box-sizing: border-box;
        }

        .right {
            text-align: right;
        }

        .btn {
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Transaksi Penjualan</h2>

<a href="/dashboard">Dashboard</a>

<br><br>

<?php if (session()->getFlashdata('error')) : ?>
    <p style="color:red;"><?= session()->getFlashdata('error'); ?></p>
<?php endif; ?>

<form action="/transaksi/store" method="post" onsubmit="return cekBayar()">

    <table id="tabel-barang">
        <thead>
            <tr>
                <th>Barang</th>
                <th width="120">Harga</th>
                <th width="100">Stok</th>
                <th width="100">Qty</th>
                <th width="140">Subtotal</th>
                <th width="80">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <select name="barang_id[]" onchange="pilihBarang(this)" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php foreach ($barang as $row) : ?>
                            <option 
                                value="<?= $row['id']; ?>"
                                data-harga="<?= $row['harga']; ?>"
                                data-stok="<?= $row['stok']; ?>"
                            >
                                <?= $row['nama_barang']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td>
                    <input type="text" class="harga" readonly>
                </td>

                <td>
                    <input type="text" class="stok" readonly>
                </td>

                <td>
                    <input type="number" name="qty[]" class="qty" value="1" min="1" oninput="hitungSubtotal(this)" required>
                </td>

                <td>
                    <input type="text" class="subtotal" readonly>
                </td>

                <td>
                    <button type="button" class="btn" onclick="hapusBaris(this)">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn" onclick="tambahBaris()">+ Tambah Barang</button>

    <br><br>

    <h3>Total: Rp <span id="grand-total-text">0</span></h3>
    <input type="hidden" name="total" id="grand-total">

    <label>Uang Bayar</label><br>
    <input type="number" name="bayar" id="bayar" required oninput="hitungKembalian()">

    <h3>Kembalian: Rp <span id="kembalian-text">0</span></h3>

    <br>

    <button type="submit" class="btn">Simpan Transaksi & Cetak Nota</button>

</form>

<script>
function formatRupiah(angka) {
    return angka.toLocaleString('id-ID');
}

function pilihBarang(select) {
    let option = select.options[select.selectedIndex];
    let harga = option.getAttribute('data-harga') || 0;
    let stok = option.getAttribute('data-stok') || 0;

    let row = select.closest('tr');

    row.querySelector('.harga').value = harga;
    row.querySelector('.stok').value = stok;

    hitungSubtotal(row.querySelector('.qty'));
}

function hitungSubtotal(input) {
    let row = input.closest('tr');

    let harga = parseInt(row.querySelector('.harga').value) || 0;
    let qty = parseInt(row.querySelector('.qty').value) || 0;
    let stok = parseInt(row.querySelector('.stok').value) || 0;

    if (qty > stok) {
        alert('Qty melebihi stok barang.');
        row.querySelector('.qty').value = stok;
        qty = stok;
    }

    let subtotal = harga * qty;

    row.querySelector('.subtotal').value = subtotal;

    hitungGrandTotal();
}

function hitungGrandTotal() {
    let subtotalInputs = document.querySelectorAll('.subtotal');
    let grandTotal = 0;

    subtotalInputs.forEach(function(input) {
        grandTotal += parseInt(input.value) || 0;
    });

    document.getElementById('grand-total').value = grandTotal;
    document.getElementById('grand-total-text').innerText = formatRupiah(grandTotal);

    hitungKembalian();
}

function hitungKembalian() {
    let grandTotal = parseInt(document.getElementById('grand-total').value) || 0;
    let bayar = parseInt(document.getElementById('bayar').value) || 0;
    let kembalian = bayar - grandTotal;

    document.getElementById('kembalian-text').innerText = formatRupiah(kembalian < 0 ? 0 : kembalian);
}

function tambahBaris() {
    let tbody = document.querySelector('#tabel-barang tbody');
    let rowPertama = tbody.querySelector('tr');
    let rowBaru = rowPertama.cloneNode(true);

    rowBaru.querySelector('select').value = '';
    rowBaru.querySelector('.harga').value = '';
    rowBaru.querySelector('.stok').value = '';
    rowBaru.querySelector('.qty').value = 1;
    rowBaru.querySelector('.subtotal').value = '';

    tbody.appendChild(rowBaru);
}

function hapusBaris(button) {
    let tbody = document.querySelector('#tabel-barang tbody');

    if (tbody.rows.length > 1) {
        button.closest('tr').remove();
        hitungGrandTotal();
    } else {
        alert('Minimal harus ada 1 barang.');
    }
}

function cekBayar() {
    let grandTotal = parseInt(document.getElementById('grand-total').value) || 0;
    let bayar = parseInt(document.getElementById('bayar').value) || 0;

    if (grandTotal <= 0) {
        alert('Pilih barang terlebih dahulu.');
        return false;
    }

    if (bayar < grandTotal) {
        alert('Uang bayar kurang.');
        return false;
    }

    return true;
}
</script>

</body>
</html>