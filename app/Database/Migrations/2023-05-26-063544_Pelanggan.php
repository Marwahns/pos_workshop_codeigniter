<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
                'type'              => 'int', 
                'constraint'        => 11, 
                'auto_increment'    => true, 
                'unsigned'          => true
            ],
			'nama' => [
                'type'              => 'varchar', 
                'constraint'        => 50
            ],
			'no_telepon' => [
                'type'              => 'varchar', 
                'constraint'        => 50
            ],
            'tipe' => [
                'type'              => 'enum', 
                'constraint'        => ['Umum', 'Membership'], 
                'default'           => 'Umum'
            ],
			'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'updated_at' => [
                'type'              => 'datetime', 
                'null'              => true
            ],
            'deleted_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
		]);
		$this->forge->addKey('id', true)
                    ->addKey(['no_telepon']);
		$this->forge->createTable('tb_pelanggan', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan', true);
    }
}
