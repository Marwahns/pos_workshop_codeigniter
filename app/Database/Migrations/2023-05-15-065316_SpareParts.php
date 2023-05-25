<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SpareParts extends Migration
{
    public function up()
    {
        // Kolom Table
        $this->forge->addField([
            'id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'supplier_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'kategori_id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true
            ],
            'kode_spareparts' => [
                'type'              => 'varchar',
                'constraint'        => 255
            ],
            'spareparts' => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'harga' => [
                'type'              => 'int',
                'constraint'        => 11,
                'null'              => true
            ],
            'stok' => [
                'type'              => 'int',
                'constraint'        => 11,
                'null'              => true
            ],
            'gambar' => [
                'type'              => 'varchar',
                'constraint'        => 11,
                'null'              => true
            ],
            'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'updated_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('supplier_id', 'tb_supplier', 'id', 'cascade', 'cascade', 'fk_supplier_id');
        $this->forge->addForeignKey('kategori_id', 'tb_kategori', 'id', 'cascade', 'cascade', 'fk_kategori_id');
        $this->forge->createTable('tb_spareparts', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_spareparts', true);
    }
    
}