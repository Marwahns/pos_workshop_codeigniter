<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Spareparts extends Seeder
{
    public function run()
    {
        $spareparts = [
            [
                'id'                => 1, 
                'kode_spareparts'   => 'SPR01',
                'kategori_id'       => '1',
                'supplier_id'       => '2',
                'spareparts'        => 'Spareparts 1',
                'harga'             => '100000',
                'stok'              => '10',
            ],
            [
                'id'                => 2, 
                'kode_spareparts'   => 'SPR02',
                'kategori_id'       => '1',
                'supplier_id'       => '3',
                'spareparts'        => 'Spareparts 2',
                'harga'             => '90000',
                'stok'              => '4',
            ],
            [
                'id'                => 3, 
                'kode_spareparts'   => 'SPR03',
                'kategori_id'       => '2',
                'supplier_id'       => '1',
                'spareparts'        => 'Spareparts 3',
                'harga'             => '50000',
                'stok'              => '7',
            ],
            
        ];
        // insert role ke tabel
        $this->db->table('tb_spareparts')->insertBatch($spareparts);
    }
}
