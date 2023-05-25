<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
    public function run()
    {
        // generate data dummy roles
        $kategori = [
            [
                'id'        => 1, 
                'kode_kategori' => 'KTG1',
                'kategori' => 'Busi'
            ],
            [
                'id'         => 2, 
                'kode_kategori' => 'KTG2',
                'kategori' => 'Kampas Rem'
            ],
            [
                'id'         => 3, 
                'kode_kategori' => 'KTG3',
                'kategori' => 'Kopling'
            ],
            [
                'id'         => 4, 
                'kode_kategori' => 'KTG4',
                'kategori' => 'Ban'
            ],
            [
                'id'         => 5, 
                'kode_kategori' => 'KTG5',
                'kategori' => 'Radiator'
            ],
            [
                'id'         => 6, 
                'kode_kategori' => 'KTG6',
                'kategori' => 'Oli'
            ],
            [
                'id'         => 7, 
                'kode_kategori' => 'KTG7',
                'kategori' => 'Gear'
            ],
            [
                'id'         => 8, 
                'kode_kategori' => 'KTG8',
                'kategori' => 'Rantai Motor'
            ],
        ];
        // insert role ke tabel
        $this->db->table('tb_kategori')->insertBatch($kategori);
    }
}
