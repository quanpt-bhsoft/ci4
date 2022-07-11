<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Course extends Migration
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
            'Price' => [
                'type' => 'INT'
            ],
            'Avartar' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Describe' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addKey('ID', True);
        $this->forge->createTable('course');
    }

    public function down()
    {
        $this->forge->dropTable('course');
    }
}
