<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Supplier extends Seeder
{
    public function run()
    {
        // generate data dummy roles
        $supplier = [
            [
                'id'            => 1, 
                'kode_supplier' => 'SPL1',
                'nama'          => 'Supplier A',
                'alamat'        => 'Jakarta',
                'no_telepon'    => '12345',
            ],
            [
                'id'            => 2, 
                'kode_supplier' => 'SPL2',
                'nama'          => 'Supplier B',
                'alamat'        => 'Bogor',
                'no_telepon'    => '34567',
            ],
            [
                'id'            => 3, 
                'kode_supplier' => 'SPL3',
                'nama'          => 'Supplier C',
                'alamat'        => 'Bekasi',
                'no_telepon'    => '123453',
            ],
            [
                'id'            => 4, 
                'kode_supplier' => 'SPL4',
                'nama'          => 'Supplier D',
                'alamat'        => 'Medan',
                'no_telepon'    => '34564',
            ],
        ];
        // insert role ke tabel
        $this->db->table('tb_supplier')->insertBatch($supplier);
    }
}
