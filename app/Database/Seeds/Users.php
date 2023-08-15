<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $request = \Config\Services::request();
        $securiy = \Config\Services::security();

        $this->db->table('tb_users')->insertBatch([
            [
                'username'   => 'superadmin',
                'email'      => 'superadmin@gmail.com',
                'password'   => password_hash('superadmin', PASSWORD_DEFAULT),
                'id_role'    => 1,
                'id_status'  => 1,
                'nama'       => 'Super Admin',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                // 'token'      => $securiy->getTokenName(),
            ],
            [
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => password_hash('admin', PASSWORD_DEFAULT),
                'id_role'    => 2,
                'id_status'  => 1,
                'nama'       => 'Admin',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                // 'token'      => $securiy->getTokenName(),
            ],
            [
                'username'   => 'kasir',
                'email'      => 'kasir@gmail.com',
                'password'   => password_hash('kasir', PASSWORD_DEFAULT),
                'id_role'    => 3,
                'id_status'  => 1,
                'nama'       => 'Kasir',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                // 'token'      => $securiy->getTokenName(),
            ],
        ]);
        // echo 'Nilai Password_Default: ' . password_verify('superadmin', '$2y$10$mX/1yvEx/X0dUH.oNEx19.5fs0N6OKmzZ..CFq8JhC391taQDkUCu');
    }
}
