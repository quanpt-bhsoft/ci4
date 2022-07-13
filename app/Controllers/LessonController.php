<?php

namespace App\Controllers;

use App\Models\LessonModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class LessonController extends BaseController
{
    public function showLesson()
    {
        $model = new LessonModel;
        $data['getLesson'] = $model->getLesson(null);
        $data['pager'] = $model->pager;
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
        $model = new LessonModel();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'title' => 'required',
                'content' => 'required',
            ];
            $idLesson = $this->request->getPost('id');
            if ($this->validate($rules)) {
                $data = [
                    'Title' => $this->request->getPost('title'),
                    'Çontent' => $this->request->getPost('content'),
                ];
                $model->update($idLesson, $data);
                return redirect()->to('showLesson');
            } else {
                $data['validation'] = $this->validator;
                $data['getLesson'] = $model->getLesson($idLesson);
                return view('Admin/UpdateLessonView', $data);
            }
        } else {
            $data['getLesson'] = $model->getLesson($id);
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
            $data['getCourse'] = $CourseModel->getCourse(null,null);
            return view('Admin/InsertLessonView', $data);
        }
    }
}
