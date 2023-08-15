<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BulanTahun extends Seeder
{
    public function run()
    {
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
