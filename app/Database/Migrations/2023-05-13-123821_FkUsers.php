<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FkUsers extends Migration
{
    public function up()
    {
        $fk_status = [
            'id_status' => [
                'type'      => 'INT',
                'constraint'=> 11,
                'unsigned'  => TRUE,
                'after'     => 'id',
            ],
            'CONSTRAINT fk_id_status_role FOREIGN KEY(`id_status`) REFERENCES `tb_status_roles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE'
        ];
        $this->forge->addColumn('tb_users', $fk_status);

        $fk_role = [
            'id_role' => [
                'type'      => 'INT',
                'constraint'=> 11,
                'unsigned'  => TRUE,
                'after'     => 'id_status',
            ],
            'CONSTRAINT fk_id_role FOREIGN KEY(`id_role`) REFERENCES `tb_roles`(`id`) ON UPDATE CASCADE ON DELETE CASCADE'
        ];
        $this->forge->addColumn('tb_users', $fk_role);
        
        
    }

    public function down()
    {
        // $this->forge->dropForeignKey('tb_users','fk_id_status_role', true);
        // $this->forge->dropColumn('tb_users', 'id_status', true);
    }
}
