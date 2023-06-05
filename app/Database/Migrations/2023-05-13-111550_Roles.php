<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
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
			'role' => [
                'type'              => 'varchar', 
                'constraint'        => 50
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
			->addUniqueKey('role');
		$this->forge->createTable('tb_roles', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_roles', true);
    }
}
