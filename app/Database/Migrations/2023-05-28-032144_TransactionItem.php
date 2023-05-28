<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_id' => [
                'type'       => 'INT',
                'constraint' => 30,
                'unsigned'       => true,
            ], 
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 30,
                'unsigned'       => true,
            ], 
            'price' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default' => 0,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => '30',
                'default' => 0,
            ],
            'created_at datetime default current_timestamp',
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addForeignKey('product_id', 'tb_spareparts', 'id','NO ACTION','CASCADE');
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id','NO ACTION','CASCADE');
        $this->forge->createTable('transaction_items');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_items');
    }
}
