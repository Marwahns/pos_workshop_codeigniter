<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
                'type'              => 'int', 
                'constraint'	    => 11, 
                'unsigned'          => true, 
                'auto_increment'    => true
            ],
            'kode_supplier' => [
                'type'              => 'varchar', 
                'constraint'        => 255
            ],
			'nama' => [
                'type'              => 'varchar', 
                'constraint'        => 255
            ],
            'alamat' => [
                'type'              => 'text', 
                'null'              => true
            ],
            'no_telepon' => [
                'type'              => 'varchar', 
                'constraint'        => 20
            ],
			'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'updated_at' => [
                'type'              => 'datetime', 
                'null'              => true
            ],
        ]);

		$this->forge->addKey('id', true)
			->addUniqueKey('kode_supplier')
            ->addUniqueKey('no_telepon');
		$this->forge->createTable('tb_supplier', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_supplier', true);
    }
}
