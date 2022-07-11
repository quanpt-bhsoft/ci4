<?php

namespace App\Controllers;

use App\Models\LessonModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class LessonControl extends BaseController
{
    public function showLesson()
    {
        $model = model(LessonModel::class);
        $data['get_lesson'] = $model->getLesson(null);
        return view('Admin/UserView', $data);
    }
    public function deleteLesson($id)
    {
        $model = new LessonModel();
        $model->delete(['ID' => $id]);
        return redirect()->to('showLesson');
    }
    public function updateLesson($id)
    {
        $model = model(LessonModel::class);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'title' => 'required',
                'content' => 'required',
            ];
            $idlesson = $this->request->getPost('id');
            if ($this->validate($rules)) {
                $data = [
                    'Title' => $this->request->getPost('title'),
                    'Çontent' => $this->request->getPost('content'),
                ];
                $model->update($idlesson, $data);
                return redirect()->to('showLesson');
            } else {
                $data['validation'] = $this->validator;
                $data['get_lesson'] = $model->getLesson($idlesson);
                return view('Admin/UpdateLessonView', $data);
            }
        } else {
            $data['get_lesson'] = $model->getLesson($id);
            return view('Admin/UpdateLessonView', $data);
        }
    }
    public function insertLesson()
    {
        $model = model(LessonModel::class);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'title' => 'required',
                'content' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'idcourse' => $this->request->getPost('course'),
                    'Title' => $this->request->getPost('title'),
                    'Content' => $this->request->getPost('content')
                ];
                $model->insert($data);
                return redirect()->to('showLesson');
            } else {
                $data['validation'] = $this->validator;
                return view('Admin/InsertLessonView', $data);
            }
        } else {
            $CourseModel = model(CourseModel::class);
            $data['get_course'] = $CourseModel->getCourse(null);
            return view('Admin/InsertLessonView', $data);
        }
    }
}
