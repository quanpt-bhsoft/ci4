<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lesson extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'idcourse' => [
                'type' => 'INT'
            ],
            'Title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'Content' => [
                'type' => 'TEXT'
            ],
        ]);
        $this->forge->addKey('ID', True);
        $this->forge->addForeignKey('idcourse', 'course', 'ID', 'CASECASE', 'CASECADE');
        $this->forge->createTable('lesson');
    }

    public function down()
    {
        $this->forge->dropTable('lesson');
    }
}
