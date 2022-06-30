<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class GetDataLesson extends Model
{
    public function get_lesson($id)
    {
        $db = db_connect();
        if($id != null)
        {
            $get_lesson = $db->query("SELECT lesson.ID,course.Name,lesson.Title,lesson.Content FROM lesson,course where course.ID = lesson.idcourse AND lesson.ID = '".$id."'");
            return $get_lesson->getResultArray();
        }
        $get_lesson = $db->query("SELECT lesson.ID,course.Name,lesson.Title,lesson.Content FROM lesson,course where course.ID = lesson.idcourse");
        return $get_lesson->getResultArray();
    }
    public function delete_lesson($id)
    {
        $db = db_connect();
        $db->query("DELETE FROM lesson where ID = '".$id."'");
    }
    public function update_lesson($id,$title,$content)
    {
        $db = db_connect();
        $update = "UPDATE lesson SET Title = '".$title."',Content = '".$content."' Where ID = '".$id."' ";
        $db->query($update);
    }
    public function insert_lesson($idcourse,$title,$content)
    {
        $db = db_connect();
        $insert = "INSERT INTO lesson value(null,'$idcourse','$title','$content') ";
        $db->query($insert);
    }
}