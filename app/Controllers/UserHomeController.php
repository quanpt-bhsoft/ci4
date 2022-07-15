<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\OrderModel;
use App\Models\UserModel;

$this->session = \Config\Services::session();

class UserHomeController extends BaseController
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
        //var_dump( $data['get_course'][0]);
        return view('home', $data);
    }
    public function showUpdateUser($id)
    {
        $model = new UserModel();
        $data['getUser'] = $model->getUser($id);
        return view('User/Home', $data);
    }
    public function updateUser($id)
    {
        $helpers = ['form'];
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        //upload anh
        $validationRule = [
            'avatar' => [
                'label' => 'Image File',
                'rules' => 'uploaded[avatar]'
                    . '|is_image[avatar]'
                    . '|mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[avatar,240000000]'
                    . '|max_dims[avatar,2048,2048]',
            ],
        ];
        $img = $this->request->getFile('avatar');
        $model = new UserModel();
        $getAvatar = $model->getUser($id);
        if ($img != "") {
            if (!$img->hasMoved()) {
                $filepath = $img->getRandomName();
                $img->move('uploads/', $filepath);
            }
            unlink("uploads/" . $getAvatar['Avatar']);
        } else {
            $filepath = $getAvatar['Avatar'];
        }
        if ($getAvatar['Password'] == $pass) {
            $data = [
                'Name' => $name,
                'Email' => $email,
                'Password' => $pass,
                'Avatar' => $filepath,
                'Status' => 0
            ];
            $model->update($id, $data);
        } else {

            $data = [
                'Name' => $name,
                'Email' => $email,
                'Password' => md5($pass),
                'Avatar' => $filepath,
                'Status' => 0
            ];
            $model->update($id, $data);
        }
        return redirect()->to('/');
    }
    public function detailCourse($id)
    {
        $model = new CourseModel();
        $getCourse = $model->getCourse($id, 1);
        $orderLesson = new LessonModel();
        $data['getLesson'] = $orderLesson->join('course', 'course.ID = lesson.idcourse')
            ->select('lesson.Title,lesson.Content')
            ->where('idcourse', $id)
            ->findAll();
        if (isset($_SESSION['user'])) {
            $orderModel  = new OrderModel();
            $data['check'] = $orderModel->selectCount('id')
                ->where('iduser', $_SESSION['user']['ID'])
                ->where('idcourse', $getCourse['ID'])
                ->where('status', 2)
                ->first();
        }
        $data['getCourse'] = $getCourse;
        return view('User/detailCourse', $data);
    }
    public function cart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'];
        }
        return view('User/cart');
    }
    public function addCart($id)
    {
        $model = new CourseModel();
        $getCourse = $model->getCourse($id, 1);

        if (count($_SESSION['cart']) == 0) {
            array_push($_SESSION['cart'], $getCourse);
            return redirect()->to('cart');
        } else {
            $index = array_search($id, array_column($_SESSION['cart'], 'ID'));
            if ($index !== false) {
                echo 'The course is already in your cart';
            } else {
                array_push($_SESSION['cart'], $getCourse);
                return redirect()->to('cart');
            }
        }
    }
    public function deleteCart($id)
    {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i]['ID'] == $id) {
                array_splice($_SESSION['cart'], $i, 1);
            }
        }
        return redirect()->to('cart');
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
                return redirect()->to('cart');
            } else {
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['ID'] == $idCourse) {
                        array_splice($_SESSION['cart'], $i, 1);
                    }
                }
                return redirect()->to('cart');
            }
        }
    }
    public function historyOrder($iduser)
    {
        $model = new OrderModel;
        $data['getOrder'] = $model->join('course', 'course.ID = `order`.idcourse')
            ->select('course.Name,course.Avatar,course.Title,course.Title,course.Price')
            ->select('`order`.status')
            ->where('`order`.iduser', $iduser)
            ->paginate(2);
        $data['pagerHistory'] = $model->pager;
        return view('User/historyOrder', $data);
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove('user');
        return redirect()->to(site_url('/'));
    }
}
