<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['Name', 'Price', 'Avatar', 'Title', 'Describe'];

    public function getCourse($id, $number)
    {
        if ($id == null) {
            if ($number == null) {
                return $this->findAll();
            } else {
                return $this->paginate($number);
            }
        }
        $where = "ID ='" . $id . "'";
        return $this->where($where)->first();
    }
}
