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
            $randomIdCourse = $faker->randomElement($idCourse);
            $randomIdUser = $faker->randomElement($idUser);
            $randomStatus = $faker->randomElement([0, 1, 2]);
            $data = array(
                'idcourse' => $randomIdCourse['ID'],
                'iduser' => $randomIdUser['ID'],
                'Status' => $randomStatus
            );
            $this->db->table('order')->insert($data);
        }
    }
}
