<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class GetData extends Model
{
    protected $table = 'user';
    public function getuser($email)
    {
        if ($email == null) {
            return $this->findAll();
        }
        $get_user = $this->db->query( "SELECT * FROM User Where Email = '".$email."' || ID = '".$email."' ");
        return $get_user->getResultArray();
    }
    public function login($email,$pass)
    {
        $get_user = $this->db->query( "SELECT * FROM User Where Email = '".$email."' AND Password = '".$pass."'",);
        return $get_user->getResultArray();
    }
    public function delete_user($id)
    {
        $this->db->query("DELETE FROM User where ID = '".$id."'");
        $this->db->query("DELETE FROM `order` where iduser = '".$id."'");
    }
    public function insert_user($name,$email,$pass,$avt,$status)
    {
        $this->db->query("INSERT INTO user values(null,'$name','$email','$avt','$pass','$status')");
    }
    public function update_user($id,$name,$email,$pass,$avt,$status)
    {
        $update = "UPDATE user SET Name = '".$name."',Email = '".$email."',Password = '".$pass."',Avatar = '".$avt."',Status = '".$status."' Where ID = '".$id."' ";
        $this->db->query($update);
    }
    public function get_course()
    {
        $table = 'order';
        $get_course = "SELECT * FROM `order`";
        $this->db->query($get_course);
    }
}