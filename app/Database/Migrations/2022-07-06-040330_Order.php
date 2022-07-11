<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
            'iduser' => [
                'type' => 'INT'
            ],
            'Status' => [
                'type' => 'INT'
            ],
        ]);
        $this->forge->addKey('ID', True);
        $this->forge->addForeignKey('iduser', 'user', 'ID', 'CASECADE', 'CASECADE');
        $this->forge->addForeignKey('idcourse', 'course', 'ID', 'CASECASE', 'CASECADE');
        $this->forge->createTable('order');
    }
    public function down()
    {
        $this->forge->dropTable('order');
    }
}
