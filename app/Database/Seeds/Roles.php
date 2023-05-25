<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Roles extends Seeder
{
    public function run()
    {
        // generate data dummy roles
        $roles = [
            [
                'id'        => 1, 
                'role' => 'Super Admin'
            ],
            [
                'id'         => 2, 
                'role' => 'Administrator'
            ],
            [
                'id'         => 3, 
                'role' => 'Kasir'
                ]
        ];
        // insert role ke tabel
        $this->db->table('tb_roles')->insertBatch($roles);
    }
}
