<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
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
            'kode_kategori' => [
                'type'              => 'varchar', 
                'constraint'        => 255
            ],
			'kategori' => [
                'type'              => 'varchar', 
                'constraint'        => 255
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
			->addUniqueKey('kode_kategori')
            ->addUniqueKey('kategori');
		$this->forge->createTable('tb_kategori', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_kategori', true);
    }
}
