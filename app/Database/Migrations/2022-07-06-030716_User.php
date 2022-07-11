<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'Name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'Avartar' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Status' => [
                'type' => 'INT'
            ],
        ]);
        $this->forge->addKey('ID', True);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
