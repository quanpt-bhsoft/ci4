<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        //$fakes = Factory::create();
        $data = array(
            'ID' => 1,
            'Name' => 'Phạm Thanh Quân',
            'Email' => 'quanpt.bhsoft@gmail.com',
            'Avatar' => '1656577601_0813797d343e460fc35b.jpg',
            'Password' => md5('12345a'),
            'Status' => '1'
        );
        $this->db->table('user')->insert($data);
    }
}
