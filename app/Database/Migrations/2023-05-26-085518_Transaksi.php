<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
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
            'penjualan_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'spareparts_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'harga_produk' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'jumlah_produk' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'diskon_produk' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'subtotal' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'updated_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
        ]);
        $this->forge->addKey('id', true)
            ->addKey(['penjualan_id'])
            ->addKey(['spareparts_id']);
        $this->forge->addForeignKey('penjualan_id', 'tb_penjualan', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('spareparts_id', 'tb_spareparts', 'id', 'cascade', 'cascade');
        $this->forge->createTable('tb_transaksi', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi', true);
    }
}
