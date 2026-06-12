<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KasirSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'kasir',
            'password' => password_hash('kasir123', PASSWORD_DEFAULT),
            'nama' => 'Kasir',
            'role' => 'kasir'
        ];

        $builder = $this->db->table('users');
        $existing = $builder->where('username', 'kasir')->get()->getRowArray();

        if ($existing) {
            $builder->where('username', 'kasir')->update($data);
            return;
        }

        $builder->insert($data);
    }
}
