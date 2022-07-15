<?php

namespace App\Controllers;

use App\Models\LessonModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class LessonController extends BaseController
{
    public function __construct()
    {
        $this->lessonModel = new LessonModel();
    }
    public function showLesson()
    {
        $data['getLesson'] = $this->lessonModel->getLesson(null);
        $data['pager'] = $this->lessonModel->pager;
        return view('Admin/UserView', $data);
    }
    public function showUpdateLesson($id)
    {
        $data['getLesson'] = $this->lessonModel->getLesson($id);
        return view('Admin/UpdateLessonView', $data);
    }
    public function showInsertLesson()
    {
        $CourseModel = model(CourseModel::class);
        $data['getCourse'] = $CourseModel->getCourse(null, null);
        return view('Admin/InsertLessonView', $data);
    }
    public function insertLesson()
    {
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
            $this->lessonModel->insert($data);
            return redirect()->to('showLesson');
        } else {
            $data['validation'] = $this->validator;
            return view('Admin/InsertLessonView', $data);
        }
    }
    public function deleteLesson($id)
    {
        $this->lessonModel->delete(['ID' => $id]);
        return redirect()->to('showLesson');
    }
    public function updateLesson($id)
    {
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
            $this->lessonModel->update($idLesson, $data);
            return redirect()->to('showLesson');
        } else {
            $data['validation'] = $this->validator;
            $data['getLesson'] = $this->lessonModel->getLesson($idLesson);
            return view('Admin/UpdateLessonView', $data);
        }
    }
}
