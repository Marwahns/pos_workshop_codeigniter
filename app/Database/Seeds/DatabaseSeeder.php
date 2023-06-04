<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $request = \Config\Services::request();
        $security = \Config\Services::security();

        ################################# Status Roles #################################
        $this->db->table('tb_status_roles')->insertBatch([
            [
                'id'         => null, 
                'status'     => 'Active',
                'created_at' => Time::now()
            ],
            [
                'id'         => null, 
                'status'     => 'InActive',
                'created_at' => Time::now()
            ]
        ]);

         ################################# Roles #################################
         $this->db->table('tb_roles')->insertBatch([
            [
                'id'   => null, 
                'role' => 'Super Admin'
            ],
            [
                'id'   => null, 
                'role' => 'Administrator'
            ],
            [
                'id'   => null, 
                'role' => 'Kasir'
                ]
        ]);

        ################################# Users #################################
        $this->db->table('tb_users')->insertBatch([
            [
                'id'         => null, 
                'username'   => 'superadmin',
                'email'      => 'superadmin@gmail.com',
                'password'   => password_hash('superadmin', PASSWORD_DEFAULT),
                'id_role'    => 1,
                'id_status'  => 1,
                'nama'       => 'Super Admin',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                'token'      => $security->getTokenName(),
            ],
            [
                'id'         => null, 
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => password_hash('admin', PASSWORD_DEFAULT),
                'id_role'    => 2,
                'id_status'  => 1,
                'nama'       => 'Admin',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                'token'      => $security->getTokenName(),
            ],
            [
                'id'         => null, 
                'username'   => 'kasir',
                'email'      => 'kasir@gmail.com',
                'password'   => password_hash('kasir', PASSWORD_DEFAULT),
                'id_role'    => 3,
                'id_status'  => 1,
                'nama'       => 'Kasir',
                'alamat'     => 'Depok',
                'ip_address' => $request->getIPAddress(),
                'token'      => $security->getTokenName(),
            ],
        ]);

        ################################# Supplier #################################
        $this->db->table('tb_supplier')->insertBatch([
            [
                'id'            => null, 
                'kode_supplier' => 'SPL1',
                'nama'          => 'Supplier A',
                'alamat'        => 'Jakarta',
                'no_telepon'    => '12345',
            ],
            [
                'id'            => null, 
                'kode_supplier' => 'SPL2',
                'nama'          => 'Supplier B',
                'alamat'        => 'Bogor',
                'no_telepon'    => '34567',
            ],
            [
                'id'            => null, 
                'kode_supplier' => 'SPL3',
                'nama'          => 'Supplier C',
                'alamat'        => 'Bekasi',
                'no_telepon'    => '123453',
            ],
            [
                'id'            => null, 
                'kode_supplier' => 'SPL4',
                'nama'          => 'Supplier D',
                'alamat'        => 'Medan',
                'no_telepon'    => '34564',
            ],
        ]);

        ################################# Category #################################
        $this->db->table('tb_kategori')->insertBatch([
            [
                'id'            => null, 
                'kode_kategori' => 'KTG1',
                'kategori'      => 'Busi'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG2',
                'kategori'      => 'Kampas Rem'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG3',
                'kategori'      => 'Kopling'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG4',
                'kategori'      => 'Ban'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG5',
                'kategori'      => 'Radiator'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG6',
                'kategori'      => 'Oli'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG7',
                'kategori'      => 'Gear'
            ],
            [
                'id'            => null, 
                'kode_kategori' => 'KTG8',
                'kategori'      => 'Rantai Motor'
            ],
        ]);

        ################################# Spare Parts #################################
        $this->db->table('tb_spareparts')->insertBatch([
            [
                'id'                => null, 
                'kode_spareparts'   => 'SPR01',
                'kategori_id'       => '1',
                'supplier_id'       => '2',
                'spareparts'        => 'Spareparts 1',
                'harga'             => '100000',
                'stok'              => '10',
            ],
            [
                'id'                => null, 
                'kode_spareparts'   => 'SPR02',
                'kategori_id'       => '1',
                'supplier_id'       => '3',
                'spareparts'        => 'Spareparts 2',
                'harga'             => '90000',
                'stok'              => '4',
            ],
            [
                'id'                => null, 
                'kode_spareparts'   => 'SPR03',
                'kategori_id'       => '2',
                'supplier_id'       => '1',
                'spareparts'        => 'Spareparts 3',
                'harga'             => '50000',
                'stok'              => '7',
            ],
            
        ]);

        ################################# Pelanggan #################################
        $this->db->table('tb_pelanggan')->insertBatch([
            [
                'id'            => null, 
                'nama'          => 'Umum',
                'no_telepon'    => '-',
                'tipe'          => 'Umum'
            ],
            [
                'id'            => null, 
                'nama'          => 'Membership',
                'no_telepon'    => '-',
                'tipe'          => 'Membership'
            ],
        ]);

        ################################# Bulan Tahun #################################
        for ($i = -1; $i < 10; $i++) {
			// generate 1 tahun kebelakang dan 10 tahun mendatang
			$tahun = ($i < 0) ? date('Y', strtotime("$i year")) : date('Y', strtotime("+$i year"));
			$data = [
				['bulan' => 'Jan', 'tahun' => $tahun, 'bulan_tahun' => "01-$tahun"],
				['bulan' => 'Feb', 'tahun' => $tahun, 'bulan_tahun' => "02-$tahun"],
				['bulan' => 'Mar', 'tahun' => $tahun, 'bulan_tahun' => "03-$tahun"],
				['bulan' => 'Apr', 'tahun' => $tahun, 'bulan_tahun' => "04-$tahun"],
				['bulan' => 'Mei', 'tahun' => $tahun, 'bulan_tahun' => "05-$tahun"],
				['bulan' => 'Jun', 'tahun' => $tahun, 'bulan_tahun' => "06-$tahun"],
				['bulan' => 'Jul', 'tahun' => $tahun, 'bulan_tahun' => "07-$tahun"],
				['bulan' => 'Agu', 'tahun' => $tahun, 'bulan_tahun' => "08-$tahun"],
				['bulan' => 'Sep', 'tahun' => $tahun, 'bulan_tahun' => "09-$tahun"],
				['bulan' => 'Okt', 'tahun' => $tahun, 'bulan_tahun' => "10-$tahun"],
				['bulan' => 'Nov', 'tahun' => $tahun, 'bulan_tahun' => "11-$tahun"],
				['bulan' => 'Des', 'tahun' => $tahun, 'bulan_tahun' => "12-$tahun"],
			];
			$this->db->table('tb_bulan_tahun')->insertBatch($data);
		}
    }
}
