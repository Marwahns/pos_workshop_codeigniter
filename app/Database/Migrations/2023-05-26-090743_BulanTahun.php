<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BulanTahun extends Migration
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
            'bulan' => [
                'type'              => 'varchar',
                'constraint'        => 10
            ],
            'tahun' => [
                'type'              => 'year',
                'constraint'        => 4
            ],
            'bulan_tahun' => [
                'type'              => 'varchar',
                'constraint'        => 10
            ]
        ]);
        $this->forge->addKey('id', true)
            ->addKey(['bulan']);
        $this->forge->createTable('tb_bulan_tahun', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_bulan_tahun', true);
    }
}
