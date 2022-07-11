<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table = 'lesson';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['idcourse','Title','Content'];
    
    public function getLesson($id)
    {
        $db = db_connect();
        if ($id != null) {
            return $this->join('course','course.ID = lesson.idcourse')
                ->select('lesson.ID,lesson.Title,lesson.Content')
                ->select('course.Name')
                ->where('lesson.ID',$id)
                ->findAll();
        }
        return $this->join('course','course.ID = lesson.idcourse')
        ->select('lesson.ID,lesson.Title,lesson.Content')
        ->select('course.Name')
        ->findAll();
    }
}
