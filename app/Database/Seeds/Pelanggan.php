<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pelanggan extends Seeder
{
    public function run()
    {
        $pelanggan = [
            [
                'id'            => 1, 
                'nama'          => 'Umum',
                'no_telepon'    => '-',
                'tipe'          => 'Umum'
            ],
            [
                'id'            => 2, 
                'nama'          => 'Membership',
                'no_telepon'    => '-',
                'tipe'          => 'Membership'
            ],
        ];
        // insert role ke tabel
        $this->db->table('tb_pelanggan')->insertBatch($pelanggan);
    }
}
