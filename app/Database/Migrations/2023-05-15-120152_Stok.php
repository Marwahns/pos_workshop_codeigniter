<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stok extends Migration
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
			'spareparts_id' => [
                'type'              => 'int', 
                'constraint'        => 11, 
                'unsigned'          => true
            ],
			'supplier_id' => [
                'type'              => 'int', 
                'constraint'        => 11, 
                'unsigned'          => true
            ],
            'tipe' => [
                'type'              => 'enum', 
                'constraint'        => ['masuk', 'keluar'], 
                'default'           => null
            ],
			'jumlah' => [
                'type'              => 'int', 
                'constraint'        => 11
            ],
			'keterangan' => [
                'type'              => 'varchar', 
                'constraint'        => 50, 
                'null'              => true
            ],
			'ip_address' => [
                'type'              => 'varchar', 
                'constraint'        => 50
            ],
			'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'updated_at' => [
                'type'              => 'datetime', 
                'null'              => true
            ],
		]);
		$this->forge->addKey('id', true)
                    ->addKey(['spareparts_id', 'supplier_id']);
		$this->forge->addForeignKey('spareparts_id', 'tb_spareparts', 'id', 'cascade', 'cascade');
		$this->forge->addForeignKey('supplier_id', 'tb_supplier', 'id', 'cascade', 'cascade');
		$this->forge->createTable('tb_stok', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_stok', true);
    }
}
