<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'idcourse' => 1,
            'Title' => 'Lập Trình C++',
            'Content' => 'Lập Trình Game',
        );
        $this->db->table('lesson')->insert($data);
    }
}
