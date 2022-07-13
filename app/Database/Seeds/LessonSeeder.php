<?php

namespace App\Database\Seeds;

use App\Models\CourseModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use Faker\Factory;


class LessonSeeder extends Seeder
{
    public function run()
    {
        $model = new CourseModel();
        $idCourse = $model->select('ID')->find();
        //var_dump($idCourse);
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $randomIDCourse = $faker->randomElements($idCourse);
            $data = array(
                'idcourse' => $randomIDCourse[0]['ID'],
                'Title' => $faker->text,
                'Content' => $faker->text
            );
            $this->db->table('lesson')->insert($data);
        }
    }
}
