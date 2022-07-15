<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

$this->session = \Config\Services::session();

class UserHomeController extends ResourceController
{
    public function user()
    {
        $model = new CourseModel();
        $getCourse = $model->getCourse(null, 6);
        $orderModel = new OrderModel;
        if (isset($_SESSION['user'])) {
            for ($i = 0; $i < count($getCourse); $i++) {
                $course = $orderModel->selectCount('id')
                    ->where('iduser', $_SESSION['user']['ID'])
                    ->where('idcourse', $getCourse[$i]['ID'])
                    ->where('status', 2)
                    ->first();
                if ($course['id'] == 0) {
                    array_push($getCourse[$i], 0);
                } else {
                    array_push($getCourse[$i], 1);
                }
            }
        }
        $data['getCourse'] = $getCourse;
        $data['pager'] = $model->pager;
        return $this->respond($data);
        // return view('home', $data);
    }
    public function showUpdateUser()
    {
        $id = $_SESSION['user']['ID'];
        $model = new UserModel();
        $data = $model->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not User');
        } else {
            $dataUser['getUser'] = $model->getUser($id);
            return $this->respond($dataUser);
            // return view('User/Home', $data);
        }
    }
    public function updateUser()
    {
        $id = $_SESSION['user']['ID'];
        $model = new UserModel();
        $datacheck = $model->find($id);
        if (empty($datacheck)) {
            return $this->failNotFound('Not User');
        } else {
            $helpers = ['form'];
            $rules = [
                'name' => 'required',
                'pass' => [
                    'rules' => 'required|min_length[8]|pass_check',
                    'errors' => [
                        'pass_check' => 'Mật khẩu phải có ít nhất 1 ký tự và 1 số',
                    ],
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
                ]
            ];
            $name = $this->request->getVar('name');
            $pass = $this->request->getVar('pass');
            //upload anh
            $img = $this->request->getFile('avatar');
            if ($this->validate($rules)) {
                $model = new UserModel();
                $getAvatar = $model->getUser($id);
                if ($img != "") {
                    if (!$img->hasMoved()) {
                        $filepath = $img->getRandomName();
                        $img->move('uploads/', $filepath);
                    }
                    if (strpos($getAvatar['Avatar'], 'via') != 8) {
                        if (file_exists("uploads/" . $getAvatar['Avatar'])) {
                            unlink("uploads/" . $getAvatar['Avatar']);
                        }
                    }
                } else {
                    $filepath = $getAvatar['Avatar'];
                }
                if ($getAvatar['Password'] == $pass) {
                    $data = [
                        'Name' => $name,
                        'Password' => $pass,
                        'Avatar' => $filepath,
                    ];
                    $model->update($id, $data);
                } else {

                    $data = [
                        'Name' => $name,
                        'Password' => md5($pass),
                        'Avatar' => $filepath,
                    ];
                    $model->update($id, $data);
                }
                return $this->respondUpdated($data);
                // return redirect()->to('/');
            } else {
                return $this->respond($this->validator->getErrors());
            }
        }
    }
    public function detailCourse($id)
    {
        $model = new CourseModel();
        $datacheck = $model->find($id);
        if (empty($datacheck)) {
            return $this->failNotFound('Not Course');
        } else {
            $getCourse = $model->getCourse($id, 1);
            if (isset($_SESSION['user'])) {
                $orderModel  = new OrderModel();
                $data['check'] = $orderModel->selectCount('id')
                    ->where('iduser', $_SESSION['user']['ID'])
                    ->where('idcourse', $getCourse['ID'])
                    ->where('status', 2)
                    ->first();
            }
            $orderLesson = new LessonModel();
            if ($data['check']['id'] != 1) {
                $data['getLesson'] = $orderLesson->join('course', 'course.ID = lesson.idcourse')
                    ->select('lesson.Title')
                    ->where('idcourse', $id)
                    ->findAll();
            } else {
                $data['getLesson'] = $orderLesson->join('course', 'course.ID = lesson.idcourse')
                    ->select('lesson.Title,lesson.Content')
                    ->where('idcourse', $id)
                    ->findAll();
            }
            $data['getCourse'] = $getCourse;
            return $this->respond($data);
            // return view('User/detailCourse', $data);
        }
    }
    public function cart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        return $this->respond($_SESSION['cart']);
        // return view('User/cart');
    }
    public function addCart($id)
    {
        $model = new CourseModel();
        $getCourse = $model->getCourse($id, 1);
        if (count($_SESSION['cart']) == 0) {
            array_push($_SESSION['cart'], $getCourse);
        } else {
            $index = array_search($id, array_column($_SESSION['cart'], 'ID'));
            if ($index !== false) {
                echo 'The course is already in your cart';
            } else {
                array_push($_SESSION['cart'], $getCourse);
            }
        }
        return $this->respond($_SESSION['cart']);
    }
    public function deleteCart($id)
    {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i]['ID'] == $id) {
                array_splice($_SESSION['cart'], $i, 1);
            }
        }
        return $this->respond($_SESSION['cart']);
    }
    public function addOrder($idCourse)
    {
        if (count($_SESSION['cart']) != 0) {
            $model = new OrderModel;
            $checkOrder = $model->selectCount('ID')
                ->where('iduser', $_SESSION['user']['ID'])
                ->where('idcourse', $idCourse)
                ->where('status', 0)
                ->first();
            if (isset($checkOrder) && $checkOrder['ID'] == 0) {
                $data = [
                    'idcourse' => $idCourse,
                    'iduser' => $_SESSION['user']['ID'],
                    'status' => 0
                ];
                $model->insert($data);
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['ID'] == $idCourse) {
                        array_splice($_SESSION['cart'], $i, 1);
                    }
                }
            } else {
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['ID'] == $idCourse) {
                        array_splice($_SESSION['cart'], $i, 1);
                    }
                }
            }
            return $this->respond($_SESSION['cart']);
        }
    }
    public function historyOrder()
    {
        $iduser = $_SESSION['user']['ID'];
        $model = new OrderModel;
        $data['getOrder'] = $model->join('course', 'course.ID = `order`.idcourse')
            ->select('course.Name,course.Avatar,course.Title,course.Title,course.Price')
            ->select('`order`.status')
            ->where('`order`.iduser', $iduser)
            ->paginate(2);
        $data['pagerHistory'] = $model->pager;
        return $this->respond($data);
        // return view('User/historyOrder', $data);
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove('user');
        echo "logout successfully";
        // return redirect()->to(site_url('/'));
    }
}
