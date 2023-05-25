<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
                'type'              => 'int', 
                'constraint'	    => 1, 
                'unsigned'          => true, 
                'auto_increment'    => true
            ],
			'status' => [
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
			->addUniqueKey('status');
		$this->forge->createTable('tb_status_roles', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_status_roles', true);
    }
}
