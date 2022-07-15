<?php

namespace App\Controllers;

use App\Models\LessonModel;
use CodeIgniter\RESTful\ResourceController;

$this->session = \Config\Services::session();

class LessonController extends ResourceController
{
    public function __construct()
    {
        $this->lessonModel = new LessonModel();
    }
    public function showLesson()
    {
        $data['getLesson'] = $this->lessonModel->getLesson(null);
        $data['pager'] = $this->lessonModel->pager;
        return $this->respond($data);
        // return view('Admin/UserView', $data);
    }
    public function showUpdateLesson($id)
    {
        $data = $this->lessonModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Lesson');
        } else {
            $getLesson = $this->lessonModel->getLesson($id);
            return $this->respond($getLesson);
            // return view('Admin/UpdateLessonView', $data);
        }
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
            return $this->fail($this->validator->getErrors());
            // $data['validation'] = $this->validator;
            // return view('Admin/InsertLessonView', $data);
        }
    }

    public function updateLesson($id)
    {
        $data = $this->lessonModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Lesson');
        } else {
            $rules = [
                'id' => 'required',
                'title' => 'required',
                'content' => 'required',
            ];
            $lessonId = $this->request->getVar('id');
            if ($this->validate($rules)) {
                $dataUpdate = [
                    'Title' => $this->request->getVar('title'),
                    'Content' => $this->request->getVar('content'),
                ];
                $this->lessonModel->update($lessonId, $dataUpdate);
                return $this->respondUpdated($dataUpdate);
            } else {
                return $this->fail($this->validator->getErrors());
                // $data['validation'] = $this->validator;
                // $data['getLesson'] = $this->lessonModel->getLesson($idLesson);
                // return view('Admin/UpdateLessonView', $data);
            }
        }
    }
        public function deleteLesson($id)
    {
        $data = $this->lessonModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Lesson');
        } else {
            $check = $this->lessonModel->delete(['ID' => $id]);
            return $this->respondDeleted($check);
            // return redirect()->to('showLesson');
        }
    }
    public function showInsertLesson()
    {
        $CourseModel = model(CourseModel::class);
        $data['getCourse'] = $CourseModel->getCourse(null, null);
        return $this->respond($data);
        // return view('Admin/InsertLessonView', $data);
    }
}
