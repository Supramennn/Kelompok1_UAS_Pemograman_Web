<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use Dompdf\Dompdf;

class Transaksi extends BaseController
{
    protected $barangModel;
    protected $transaksiModel;
    protected $detailModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel = new DetailTransaksiModel();
    }

    public function index()
    {
        $redirect = $this->requireLogin();

        if ($redirect !== null) {
            return $redirect;
        }

        $data['barang'] = $this->barangModel->findAll();

        return view('transaksi/index', $data);
    }

    public function store()
    {
        $redirect = $this->requireLogin();

        if ($redirect !== null) {
            return $redirect;
        }

        $barangIds = $this->request->getPost('barang_id');
        $qtys = $this->request->getPost('qty');
        $bayar = (int) $this->request->getPost('bayar');

        if (!$barangIds || !$qtys) {
            return redirect()->back()->with('error', 'Barang belum dipilih.');
        }

        $items = [];
        $total = 0;

        // Gabungkan qty kalau barang yang sama dipilih lebih dari sekali
        $qtyPerBarang = [];

        foreach ($barangIds as $index => $barangId) {
            if (!$barangId) {
                continue;
            }

            $qty = (int) $qtys[$index];

            if ($qty <= 0) {
                continue;
            }

            if (!isset($qtyPerBarang[$barangId])) {
                $qtyPerBarang[$barangId] = 0;
            }

            $qtyPerBarang[$barangId] += $qty;
        }

        if (empty($qtyPerBarang)) {
            return redirect()->back()->with('error', 'Data barang tidak valid.');
        }

        foreach ($qtyPerBarang as $barangId => $qty) {
            $barang = $this->barangModel->find($barangId);

            if (!$barang) {
                return redirect()->back()->with('error', 'Barang tidak ditemukan.');
            }

            if ($qty > $barang['stok']) {
                return redirect()->back()->with('error', 'Stok ' . $barang['nama_barang'] . ' tidak mencukupi.');
            }

            $subtotal = $barang['harga'] * $qty;
            $total += $subtotal;

            $items[] = [
                'barang' => $barang,
                'qty' => $qty,
                'subtotal' => $subtotal
            ];
        }

        if ($bayar < $total) {
            return redirect()->back()->with('error', 'Uang bayar kurang.');
        }

        $kembalian = $bayar - $total;
        $kodeTransaksi = 'TRX' . date('YmdHis');

        $db = \Config\Database::connect();
        $db->transStart();

        $transaksiId = $this->transaksiModel->insert([
            'kode_transaksi' => $kodeTransaksi,
            'total' => $total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'user_id' => session()->get('user_id')
        ], true);

        foreach ($items as $item) {
            $barang = $item['barang'];
            $qty = $item['qty'];

            $this->detailModel->insert([
                'transaksi_id' => $transaksiId,
                'barang_id' => $barang['id'],
                'harga' => $barang['harga'],
                'qty' => $qty,
                'subtotal' => $item['subtotal']
            ]);

            $this->barangModel->update($barang['id'], [
                'stok' => $barang['stok'] - $qty
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Transaksi gagal disimpan.');
        }

        return redirect()->to('/transaksi/nota/' . $transaksiId);
    }

    public function cetakNota($id)
    {
        $redirect = $this->requireLogin();

        if ($redirect !== null) {
            return $redirect;
        }

        $transaksi = $this->transaksiModel
            ->select('transaksi.*, users.nama AS nama_kasir')
            ->join('users', 'users.id = transaksi.user_id', 'left')
            ->where('transaksi.id', $id)
            ->first();

        if (!$transaksi) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        if (session()->get('role') === 'kasir' && (int) $transaksi['user_id'] !== (int) session()->get('user_id')) {
            return redirect()->to('/transaksi')->with('error', 'Anda tidak memiliki akses ke nota tersebut.');
        }

        $detail = $this->detailModel
            ->select('detail_transaksi.*, barang.nama_barang')
            ->join('barang', 'barang.id = detail_transaksi.barang_id')
            ->where('transaksi_id', $id)
            ->findAll();

        $data = [
            'transaksi' => $transaksi,
            'detail' => $detail
        ];

        $html = view('pdf/nota', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $itemCount = count($detail);

        // Fungsi konversi mm ke point
        $mmToPt = function ($mm) {
            return ($mm / 25.4) * 72;
        };

        // Lebar thermal 80mm
        $paperWidth = $mmToPt(80);

        // Tinggi dasar nota: header, info transaksi, total, bayar, footer
        $baseHeight = 115;

        // Tinggi tambahan per item barang
        $rowHeight = 8;

        // Total tinggi nota
        $paperHeightMm = $baseHeight + ($itemCount * $rowHeight);

        // Minimal tinggi biar nota tetap enak dilihat
        if ($paperHeightMm < 120) {
            $paperHeightMm = 120;
        }

$paperHeight = $mmToPt($paperHeightMm);

$dompdf->setPaper([0, 0, $paperWidth, $paperHeight], 'portrait');
        $dompdf->render();
        $dompdf->stream('nota-' . $transaksi['kode_transaksi'] . '.pdf', ['Attachment' => false]);
    }
}
