<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['Name','Email','Avatar','Password','Status'];

    public function getUser($email)
    {
        if ($email == null) {
            return $this->paginate(2);
        }
        $where = "Email = '".$email."' OR ID ='".$email."'";
        return $this->where($where)->first();
    }
    public function login($email, $pass)
    {
        $where = "Email = '" . $email . "' AND Password = '" . $pass . "'";
        return $this->where($where)->first();
    }
    public function deleteUser($id)
    {
        $this->delete(['ID' => $id]);
    }
    public function insertUser($data)
    {
        $this->set($data);
        return $this->insert();
    }
}
