<?php

namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\RESTful\ResourceController;


$this->session = \Config\Services::session();

class CourseController extends ResourceController
{
    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }
    public function showCourse($id = null)
    {
        $getCourse =  $this->courseModel->getCourse($id, 2);
        $data['getCourse'] = $getCourse;
        $data['pager'] =  $this->courseModel->pager;
        return $this->respond($data);
        // return view('Admin/UserView', $data);
    }
    public function showUpdateCourse($id)
    {
        $data = $this->courseModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Course');
        } else {
            $getCourse =  $this->courseModel->getCourse($id, 2);
            return $this->respond($getCourse);
        }
        // return view('Admin/UpdateCourseView', $data);
    }
    public function insertCourse()
    {
        $helpers = ['form'];
        $data = [];
        $rules = [
            'name' => 'required',
            'price' => [
                'rules' => 'required|price_check',
                'errors' => [
                    'required' => 'Nhâp Giá Khóa Học',
                    'price_check' => 'Nhập Số Giá Khóa Học',
                ]
            ],
            'userfile' => [
                'label' => 'Image File',
                'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userfile,240000000]'
                    . '|max_dims[userfile,2048,2048]',
                'errors' => [
                    'is_image' => 'Chọn ảnh đại diện'
                ]
            ],
            'title' => 'required',
            'describe' => 'required',
        ];
        if ($this->validate($rules)) {
            $img = $this->request->getFile('userfile');
            if (!$img->hasMoved()) {
                $filePath = $img->getRandomName();
                $img->move('uploads/', $filePath);
            }
            //echo $filepath;
            $data = [
                'Name' => $this->request->getPost('name'),
                'Price' => $this->request->getPost('price'),
                'Avatar' => $filePath,
                'Title' => $this->request->getPost('title'),
                'Describe' => $this->request->getPost('describe'),
            ];
            $this->courseModel->insert($data);
            return $this->respondCreated($data);
            // return redirect()->to('showCourse');
        } else {
            return $this->fail($this->validator->getErrors());
            // $data['validation'] = $this->validator;
            // return view('Admin/InsertCourseView', $data);
        }
    }
    public function updateCourse($id)
    {
        $data = $this->courseModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Course');
        } else {
            $helpers = ['form'];
            $rules = [
                'name' => 'required',
                'price' => [
                    'rules' => 'required|price_check',
                    'errors' => [
                        'required' => 'Nhâp Giá Khóa Học',
                        'price_check' => 'Nhập Số Giá Khóa Học',
                    ]
                ],
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[userfile]'
                        . '|is_image[userfile]'
                        . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[userfile,240000000]'
                        . '|max_dims[userfile,2048,2048]',
                    'errors' => [
                        'is_image' => 'Chọn ảnh đại diện'
                    ]
                ],
                'title' => 'required',
                'describe' => 'required',
            ];
            $idCourse = $this->request->getPost('id');
            if ($this->validate($rules)) {
                $img = $this->request->getFile('userfile');
                if (!$img->hasMoved()) {
                    $filePath = $img->getRandomName();
                    $img->move('uploads/', $filePath);
                }
                $data = [
                    'Name' => $this->request->getPost('name'),
                    'Price' => $this->request->getPost('price'),
                    'Avatar' => $filePath,
                    'Title' => $this->request->getPost('title'),
                    'Describe' => $this->request->getPost('describe'),
                ];
                $getCourse =  $this->courseModel->getCourse($idCourse, 1);
                if (strpos($getCourse[0]['Avatar'], 'via') != 8) {
                    unlink("uploads/" . $getCourse[0]['Avatar']);
                }
                $this->courseModel->update( $getCourse[0]['ID'], $data);
                return $this->respondUpdated($data);
                // return redirect()->to('showCourse');
            } else {
                return $this->fail($this->validator->getErrors());
                // $data['validation'] = $this->validator;
                // $data['getCourse'] =  $this->courseModel->getCourse($idCourse);
                // return view('Admin/UpdateCourseView', $data);
            }
        }
    }
    public function deleteCourse($id)
    {
        $data = $this->courseModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Khong co lesson nay');
        } else {
            $getCourse =  $this->courseModel->getCourse($id, 1);
            if (strpos($getCourse['Avatar'], 'via') != 8) {
                unlink("uploads/" . $getCourse['Avatar']);
            }
            $check = $this->courseModel->delete(['ID' => $id]);
            return $this->respondDeleted($check);
            // return redirect()->to('showCourse');
        }
    }
    public function showInsertCourse()
    {
        return view('Admin/InsertCourseView');
    }
}
