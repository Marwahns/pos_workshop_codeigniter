<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
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
            'user_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'pelanggan_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'invoice' => [
                'type'              => 'varchar',
                'constraint'        => 50
            ],
            'total_harga' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'diskon' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'total_akhir' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'tunai' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'kembalian' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'catatan' => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'tanggal' => [
                'type'              => 'date',
                'null'              => true
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
            ->addKey(['user_id'])
            ->addKey(['pelanggan_id'])
            ->addKey(['invoice']);
        $this->forge->addForeignKey('user_id', 'tb_users', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('pelanggan_id', 'tb_pelanggan', 'id', 'cascade', 'cascade');
        $this->forge->createTable('tb_penjualan', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_penjualan', true);
    }
}
