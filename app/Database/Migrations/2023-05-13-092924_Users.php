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
            'email'    => [
                'type'              => 'varchar',
                'constraint'        => 255
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
                'constraint'        => 255,
                'null'              => true
            ],
            'alamat' => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'token'    => [
                'type'              => 'varchar',
                'constraint'        => 255,
                'null'              => true
            ],
            'ip_address' => [
                'type'              => 'varchar',
                'constraint'        => 100,
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
        $this->forge->addKey('id', true);
            // ->addUniqueKey(['email', 'username']);
        $this->forge->createTable('tb_users', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_users', true);
    }
}
