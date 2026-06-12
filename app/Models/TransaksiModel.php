<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kode_transaksi',
        'tanggal',
        'total',
        'bayar',
        'kembalian',
        'user_id'
    ];
}