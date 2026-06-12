<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['transaksi'] = $this->transaksiModel
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('laporan/index', $data);
    }

    public function cetakPdf()
    {
        $data['transaksi'] = $this->transaksiModel
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        $html = view('pdf/laporan', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan-transaksi.pdf', ['Attachment' => false]);
    }
}