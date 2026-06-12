<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $redirect = $this->requireLogin();

        if ($redirect !== null) {
            return $redirect;
        }

        $data['barang'] = $this->barangModel->findAll();

        return view('barang/index', $data);
    }

    public function create()
    {
        $redirect = $this->requireAdmin();

        if ($redirect !== null) {
            return $redirect;
        }

        return view('barang/create');
    }

    public function store()
    {
        $redirect = $this->requireAdmin();

        if ($redirect !== null) {
            return $redirect;
        }

        $this->barangModel->save([
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $redirect = $this->requireAdmin();

        if ($redirect !== null) {
            return $redirect;
        }

        $data['barang'] = $this->barangModel->find($id);

        return view('barang/edit', $data);
    }

    public function update($id)
    {
        $redirect = $this->requireAdmin();

        if ($redirect !== null) {
            return $redirect;
        }

        $this->barangModel->update($id, [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil diupdate.');
    }

    public function delete($id)
    {
        $redirect = $this->requireAdmin();

        if ($redirect !== null) {
            return $redirect;
        }

        $this->barangModel->delete($id);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil dihapus.');
    }
}
