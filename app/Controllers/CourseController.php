<?php

namespace App\Controllers;

use App\Models\CourseModel;


$this->session = \Config\Services::session();

class CourseController extends BaseController
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
        return view('Admin/UserView', $data);
    }
    public function deleteCourse($id)
    {
        $getCourse =  $this->courseModel->getCourse($id, 1);
        if (strpos($getCourse['Avatar'], 'via') != 8) {
            unlink("uploads/" . $getCourse['Avatar']);
        }
        $this->courseModel->delete(['ID' => $id]);
        return redirect()->to('showCourse');
    }
    public function showInsertCourse()
    {
        return view('Admin/InsertCourseView');
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
            return redirect()->to('showCourse');
        } else {
            $data['validation'] = $this->validator;
            return view('Admin/InsertCourseView', $data);
        }
    }
    public function showUpdateCourse($id)
    {
        $data['getCourse'] =  $this->courseModel->getCourse($id, 2);
        return view('Admin/UpdateCourseView', $data);
    }
    public function updateCourse($id)
    {
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
            if (strpos($getCourse['Avatar'], 'via') != 8) {
                unlink("uploads/" . $getCourse['Avatar']);
            }
            $this->courseModel->update($idCourse, $data);
            return redirect()->to('showCourse');
        } else {
            $data['validation'] = $this->validator;
            $data['getCourse'] =  $this->courseModel->getCourse($idCourse);
            return view('Admin/UpdateCourseView', $data);
        }
    }
}
