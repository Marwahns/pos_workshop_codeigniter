<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\MySQLi\Forge;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'id_status' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_role' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'email'    => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'username' => [
                'type'              => 'varchar',
                'constraint'        => 30,
                'null'              => true
            ],
            'password' => [
                'type'              => 'varchar',
                'constraint'        => 255
            ],
            'nama' => [
                'type'              => 'varchar',
                'constraint'        => 255
            ],
            'alamat' => [
                'type'              => 'varchar',
                'constraint'        => 255
            ],
            'token'    => [
                'type'              => 'varchar',
                'constraint'        => 255
            ],
            'ip_address' => [
                'type'              => 'varchar',
                'constraint'        => 100
            ],
            'created_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'updated_at' => [
                'type'              => 'datetime',
                'null'              => true
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_status', 'tb_status_roles', 'id', 'cascade', 'cascade', 'fk_id_status');
        $this->forge->addForeignKey('id_role', 'tb_roles', 'id', 'cascade', 'cascade', 'fk_id_role');
        $this->forge->createTable('tb_users', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_users', true);
    }
}
