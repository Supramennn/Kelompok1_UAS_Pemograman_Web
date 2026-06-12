<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<main class="page">
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Transaksi Penjualan</h1>
                <p class="subtitle">Kasir: <?= esc(session()->get('nama')); ?></p>
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

    <form action="/transaksi/store" method="post" onsubmit="return cekBayar()">
        <div class="transaction-layout">
            <section class="panel">
                <div class="panel-header toolbar">
                    <div>
                        <h2>Daftar Belanja</h2>
                        <p class="subtitle">Pilih barang dan jumlah pembelian.</p>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="tambahBaris()">Tambah Barang</button>
                </div>

                <div class="table-wrap">
                    <table class="data-table" id="tabel-barang">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th class="right" width="140">Harga</th>
                                <th class="center" width="100">Stok</th>
                                <th class="center" width="100">Qty</th>
                                <th class="right" width="150">Subtotal</th>
                                <th class="center" width="100">Aksi</th>
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
                                                <?= esc($row['nama_barang']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="harga right" readonly>
                                </td>
                                <td>
                                    <input type="text" class="stok center" readonly>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="qty center" value="1" min="1" oninput="hitungSubtotal(this)" required>
                                </td>
                                <td>
                                    <input type="text" class="subtotal right" readonly>
                                </td>
                                <td class="center">
                                    <button type="button" class="btn btn-small btn-danger" onclick="hapusBaris(this)">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <aside class="summary-box">
                <div class="summary-item">
                    <span>Total</span>
                    <strong>Rp <span id="grand-total-text">0</span></strong>
                    <input type="hidden" name="total" id="grand-total">
                </div>

                <div class="panel">
                    <div class="panel-body form-grid">
                        <div class="form-field">
                            <label for="bayar">Uang Bayar</label>
                            <input type="number" name="bayar" id="bayar" min="0" required oninput="hitungKembalian()">
                        </div>

                        <div class="summary-item">
                            <span>Kembalian</span>
                            <strong>Rp <span id="kembalian-text">0</span></strong>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Transaksi & Cetak Nota</button>
                    </div>
                </div>
            </aside>
        </div>
    </form>
</main>

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
