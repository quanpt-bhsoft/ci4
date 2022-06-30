<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class GetDataCourse extends Model
{
    protected $table = 'course';
    public function get_course($id)
    {
        if ($id == null)
        {
            return $this->findAll();
        }
        $get_course = $this->db->query( "SELECT * FROM course Where ID = '".$id."' ");
        return $get_course->getResultArray();
    }
    public function delete_course($id)
    {
        $this->db->query("DELETE FROM course where ID = '".$id."'");
        $this->db->query("DELETE FROM `order` where idcourse = '".$id."'");
        $this->db->query("DELETE FROM lesson where idcourse = '".$id."'");
    }
    public function insert_course($name,$price,$avt,$title,$describe)
    {
        $this->db->query("INSERT INTO course values(null,'$name','$price','$avt','$title','$describe')");
    }
    public function update_user($id,$name,$price,$avt,$title,$describe)
    {
        $update = "UPDATE course SET Name = '".$name."',Price = '".$price."',Title = '".$title."',Avatar = '".$avt."',`Describe` = '".$describe."' Where ID = '".$id."' ";
        $this->db->query($update);
    }
}