<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 30,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'total_amount' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default' => 0,
            ],
            'tendered' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default' => 0,
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');

    }
}
