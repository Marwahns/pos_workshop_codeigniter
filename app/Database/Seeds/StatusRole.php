<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class StatusRole extends Seeder
{
    public function run()
    {
        // generate data dummy status roles
        $roles = [
            [
                'id'         => 1, 
                'status'     => 'Active',
                'created_at' => Time::now()
            ],
            [
                'id'         => 2, 
                'status'     => 'InActive',
                'created_at' => Time::now()
            ]
        ];
        // insert role ke tabel
        $this->db->table('tb_status_roles')->insertBatch($roles);
    }
}
