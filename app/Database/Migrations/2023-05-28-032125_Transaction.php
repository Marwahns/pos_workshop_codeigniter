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
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'customer' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true
            ],
            'discount' => [
                'type'           => 'INT',
                'constraint'     => '2',
                'default'        => 0,
                'null'           => true
            ],
            'total_amount' => [
                'type'           => 'FLOAT',
                'constraint'     => '12,2',
                'default'        => 0,
            ],
            'tendered' => [
                'type'           => 'FLOAT',
                'constraint'     => '12,2',
                'default'        => 0,
            ],
            'created_at datetime default current_timestamp',
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
