<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CourseModel;
use CodeIgniter\Test\Fabricator;
use Faker\Factory;
use Faker\Provider\Image;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $data = array(
                'Name' => $faker->lexify(),
                'Price' => 5000000,
                'Avatar' =>  Image::imageUrl(800, 400),
                'Title' => $faker->text,
                'Describe' => $faker->text
            );
            $this->db->table('course')->insert($data);
        }
    }
}
