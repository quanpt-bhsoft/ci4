<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CourseModel;
use App\Models\UserModel;
use CodeIgniter\Test\Fabricator;
use Faker\Factory;
use Faker\Provider\Image;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $modelCourse = new CourseModel();
        $modelUser = new UserModel();

        $idCourse = $modelCourse->select('ID')->find();
        $idUser = $modelUser->select('ID')->find();

        $faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $randomIdCourse = $faker->randomElements($idCourse);
            $randomIdUser = $faker->randomElements($idUser);
            $randomStatus = $faker->randomElements([0, 1, 2]);
            $data = array(
                'idcourse' => $randomIdCourse[0]['ID'],
                'iduser' => $randomIdUser[0]['ID'],
                'Status' => $randomStatus[0]
            );
            $this->db->table('order')->insert($data);
        }
    }
}
