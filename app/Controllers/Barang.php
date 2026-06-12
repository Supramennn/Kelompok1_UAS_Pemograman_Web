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
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data['barang'] = $this->barangModel->findAll();

        return view('barang/index', $data);
    }

    public function create()
    {
        return view('barang/create');
    }

    public function store()
    {
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
        $data['barang'] = $this->barangModel->find($id);

        return view('barang/edit', $data);
    }

    public function update($id)
    {
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
        $this->barangModel->delete($id);

        return redirect()->to('/barang')->with('success', 'Data barang berhasil dihapus.');
    }
}