<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\OrderModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class User extends BaseController
{
    public function user()
    {
        $model = model(CourseModel::class);

        $get_course = $model->getCourse(null);

        $orderModel = model(OrderModel::class);
        if (isset($_SESSION['user'])) {
            for ($i = 0; $i < count($get_course); $i++) {
                $course = $orderModel->selectCount('id')
                    ->where('iduser', $_SESSION['user']['ID'])
                    ->where('idcourse', $get_course[$i]['ID'])
                    ->where('status', 2)
                    ->findAll();
                foreach ($course as $course) :
                    if ($course['id'] == 0) {
                        array_push($get_course[$i], 0);
                    } else {
                        array_push($get_course[$i], 1);
                    }
                endforeach;
            }
        }
        $data['get_course'] = $get_course;
        return view('home', $data);
    }
    public function updateUser($id)
    {
        $helpers = ['form'];
        if ($this->request->getMethod() == 'post') {
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
            $model = model(UserModel::class);
            $get_avatar = $model->getUser($id);
            if ($img != "") {
                if (!$img->hasMoved()) {
                    $filepath = $img->getRandomName();
                    $img->move('uploads/', $filepath);
                }
                unlink("uploads/" . $get_avatar[0]['Avatar']);
            } else {
                $filepath = $get_avatar[0]['Avatar'];
            }
            if ($get_avatar[0]['Password'] == $pass) {
                $model->updateUser($id, $name, $email, $pass, $filepath, 0);
            } else {
                $model->updateUser($id, $name, $email, md5($pass), $filepath, 0);
            }
            return redirect()->to('/');
        } else {
            $model = model(UserModel::class);
            $data['get_user'] = $model->getUser($id);
            return view('User/Home', $data);
        }
    }
    public function detailCourse($id)
    {
        $model = model(CourseModel::class);
        $get_course = $model->getCourse($id);
        //var_dump($get_course);
        $orderlesson = new LessonModel();

        $data['get_lesson'] = $orderlesson->join('course', 'course.ID = lesson.idcourse')
            ->select('lesson.Title,lesson.Content')
            ->where('idcourse', $id)
            ->findAll();
        if (isset($_SESSION['user'])) {
            $orderModel  = new OrderModel();
            $data['check'] = $orderModel->selectCount('id')
                ->where('iduser', $_SESSION['user']['ID'])
                ->where('idcourse', $get_course['ID'])
                ->where('status', 2)
                ->findAll();
        }

        //var_dump($data['check']);
        $data['get_course'] = $get_course;
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
        $model = model(CourseModel::class);
        $get_course = $model->getCourse($id);

        if (count($_SESSION['cart']) == 0) {
            array_push($_SESSION['cart'], $get_course);
            return redirect()->to('cart');
        } else {
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['ID'] != $id) {
                    array_push($_SESSION['cart'], $get_course[0]);
                    return redirect()->to('cart');
                } else {
                    echo 'The course is already in your cart';
                }
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
    public function addOrder($idcourse)
    {
        if (isset($_SESSION['user'])) {
            if (count($_SESSION['cart']) != 0) {
                $model = new OrderModel;
                $check_order = $model->selectCount('ID')
                    ->where('iduser', $_SESSION['user']['ID'])
                    ->where('idcourse', $idcourse)
                    ->where('status', 0)
                    ->findAll();
                if (isset($check_order) && $check_order[0]['ID'] == 0) {
                    $data = [
                        'idcourse' => $idcourse,
                        'iduser' => $_SESSION['user']['ID'],
                        'status' => 0
                    ];
                    $model->insert($data);
                    return redirect()->to('delete_cart/' . $idcourse);
                } else {
                    return redirect()->to('delete_cart/' . $idcourse);
                }
            }
        } else {
            return redirect()->to('login');
        }
    }
    public function historyOrder($iduser)
    {
        $model = new OrderModel;
        $data['get_order'] = $model->join('course', 'course.ID = `order`.idcourse')
            ->select('course.Name,course.Avatar,course.Title,course.Title,course.Price')
            ->select('`order`.status')
            ->where('`order`.iduser', $iduser)
            ->findAll();

        return view('User/historyOrder', $data);
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove('user');
        return redirect()->to(site_url('/'));
    }
}
