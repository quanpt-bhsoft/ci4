<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'idcourse' => 1,
            'iduser' => 1,
            'Status' => 0
        );
        $this->db->table('user')->insert($data);
    }
}
