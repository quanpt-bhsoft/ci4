<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use CodeIgniter\Test\Fabricator;
use Faker\Factory;
use Faker\Provider\Image;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $formatters = [
                'Name' => $faker->name,
                'Email' => $faker->email,
                'Avatar'     => Image::imageUrl(800, 400),
                'Password'      => $faker->md5(),
                'Status'      => 0,
            ];
            $this->db->table('user')->insert($formatters);
        }
    }
}
