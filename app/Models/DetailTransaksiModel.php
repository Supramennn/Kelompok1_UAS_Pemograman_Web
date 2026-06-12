<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'transaksi_id',
        'barang_id',
        'harga',
        'qty',
        'subtotal'
    ];
}