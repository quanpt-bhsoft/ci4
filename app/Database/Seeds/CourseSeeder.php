<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'ID' => '1',
            'Name' => 'C++',
            'Price' => 5000000,
            'Avatar' => '1656577601_0813797d343e460fc35b.jpg',
            'Title' => 'Lập Trình Game',
            'Describe' => 'Lập Trình Game'
        );
        $this->db->table('course')->insert($data);
    }
}
