<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('Roles');
        $this->call('StatusRole');
        $this->call('Users');
        $this->call('Supplier');
        $this->call('Kategori');
        $this->call('Spareparts');
        $this->call('Pelanggan');
    }
}
