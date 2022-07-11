<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\OrderModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class CourseControl extends BaseController
{
    public function showCourse($id = null)
    {
        $model = model(CourseModel::class);
        $get_course = $model->getCourse($id);
        $data['get_course'] = $get_course;
        return view('Admin/UserView', $data);
    }
    public function deleteCourse($id)
    {
        $model = model(CourseModel::class);
        $get_course = $model->getCourse($id);
        unlink("uploads/" . $get_course['Avatar']);
        $model->delete(['ID' => $id]);
        $modelorder = new OrderModel();
        $modelorder->delete(['idcourse' => $id]);
        $modellesson = new LessonModel();
        $modellesson->delete(['idcourse' => $id]);
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
                $filepath = $img->getRandomName();
                $img->move('uploads/', $filepath);
            }
            //echo $filepath;
            $data = [
                'Name' => $this->request->getPost('name'),
                'Price' => $this->request->getPost('price'),
                'Avatar' => $filepath,
                'Title' => $this->request->getPost('title'),
                'Describe' => $this->request->getPost('describe'),
            ];
            $model = new CourseModel();
            $model->insert($data);
            return redirect()->to('showCourse');
        } else {
            $data['validation'] = $this->validator;
            return view('Admin/InsertCourseView', $data);
        }
    }
    public function updateCourse($id)
    {
        $helpers = ['form'];

        if ($this->request->getMethod() == 'post') {
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
            $idcourse = $this->request->getPost('id');
            if ($this->validate($rules)) {
                $img = $this->request->getFile('userfile');
                if (!$img->hasMoved()) {
                    $filepath = $img->getRandomName();
                    $img->move('uploads/', $filepath);
                }
                $data = [
                    'Name' => $this->request->getPost('name'),
                    'Price' => $this->request->getPost('price'),
                    'Avatar' => $filepath,
                    'Title' => $this->request->getPost('title'),
                    'Describe' => $this->request->getPost('describe'),
                ];
                $model = model(CourseModel::class);
                $get_course = $model->getCourse($idcourse);
                unlink("uploads/" . $get_course['Avatar']);
                $model->update($idcourse, $data);
                return redirect()->to('showCourse');
            } else {
                $data['validation'] = $this->validator;
                $model = model(CourseModel::class);
                $data['getcourse'] = $model->getCourse($idcourse);
                return view('Admin/UpdateCourseView', $data);
            }
        } else {
            $model = new CourseModel();
            $data['getcourse'] = $model->getCourse($id);
            return view('Admin/UpdateCourseView', $data);
        }
    }
}
