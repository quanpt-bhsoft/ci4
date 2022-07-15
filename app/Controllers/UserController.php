<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

$this->session = \Config\Services::session();

class UserController extends ResourceController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function checkLogin()
    {
        $rules = [
            'email' => 'required',
            'pass' => 'required',
        ];
        $data = [];
        if ($this->validate($rules)) {
            $email = $this->request->getPost('email');
            $pass = $this->request->getPost('pass');
            $check = $this->userModel->login($email, md5($pass));
            if (isset($check)) {
                $_SESSION['user'] = $check;
                if ($check['Status'] == 1) {
                    echo "successfully logged into admin";
                    // return redirect()->to('showUser');
                } else {
                    echo "successfully logged into user";
                    // return redirect()->to('/');
                }
            } else {
                echo "Login failed";
            }
        } else {
            return $this->fail($this->validator->getErrors());
            // $data['validation'] = $this->validator;
            // return view('Admin/LoginView', $data);
        }
    }
    public function showUser($email = null)
    {
        $getUser = $this->userModel->getUser($email);
        for ($i = 0; $i < count($getUser); $i++) {
            $getNameCourse = new OrderModel();
            $course = $getNameCourse->join('course', 'course.ID = `order`.idcourse')
                ->join('user', 'user.ID = `order`.iduser')
                ->select('course.Name')
                ->where('`order`.status', 2)
                ->where('user.Email', $getUser[$i]['Email'])
                ->findAll();
            //var_dump($course);
            if ($course == false) {
                array_push($getUser[$i], ' ');
            } else {
                for ($j = 0; $j < count($course); $j++) {
                    array_push($getUser[$i], implode(" ", $course[$j]));
                }
            }
        }
        $data['getUser'] = $getUser;
        $data['pager'] = $this->userModel->pager;
        return $this->respond($data);
        // return view('Admin/UserView', $data);
    }


    public function insertUser()
    {
        $helpers = ['form'];
        $data = [];
        $rules = [
            'name' => 'required',
            'email' => [
                'rules' => 'required|valid_email',
                'lable' => 'Email address',
                'errors' => [
                    'required' => 'Nhâp dữ liệu cho Email',
                    'valid_email' => 'Nhập đúng định dạng dữ liệu '
                ]
            ],
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
            ],
            'status' => 'required|in_list[0,1]',
        ];
        if ($this->validate($rules)) {
            //upload anh
            $img = $this->request->getFile('userfile');
            if (!$img->hasMoved()) {
                $filepath = $img->getRandomName();
                $img->move('uploads/', $filepath);
            }
            //echo $filepath;
            $data = [
                'ID' => NULL,
                'Name' => $this->request->getPost('name'),
                'Email' => $this->request->getPost('email'),
                'Avatar' => $filepath,
                'Password' => md5($this->request->getPost('pass')),
                'Status' => $this->request->getPost('status'),
            ];
            $this->userModel->insertUser($data);
            $check['data'] = $data;
            return $this->respond($check);
            // return redirect()->to('showUser');
        } else {
            return $this->fail($this->validator->getErrors());
            // $data['validation'] = $this->validator;
            // return view('Admin/InsertUserView', $data);
        }
    }
    public function showUpdateUser($id)
    {
        $data = $this->userModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not User');
        } else {
            $user['getUser'] = $this->userModel->getUser($id);
            return $this->respond($user);
            // return view('Admin/UpdateUserView', $user);
        }
    }
    public function updateUser($id)
    {
        $data = $this->userModel->find($id);
        if (empty($data)) {
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
                ],
                'status' => 'required|in_list[0,1]',
            ];
            $iduser = $this->request->getPost('id');
            $name = $this->request->getPost('name');
            $pass = $this->request->getPost('pass');
            $status = $this->request->getPost('status');
            //upload anh
            $img = $this->request->getFile('userfile');
            if ($this->validate($rules)) {
                $getAvatar = $this->userModel->getUser($id);
                if ($img != "") {
                    if (!$img->hasMoved()) {
                        $filepath = $img->getRandomName();
                        $img->move('uploads/', $filepath);
                    }
                    if (strpos($getAvatar['Avatar'], 'via') != 8) {
                        if(file_exists("uploads/" . $getAvatar['Avatar'])){
                            unlink("uploads/" . $getAvatar['Avatar']);
                        }
                    }
                } else {
                    $filepath = $getAvatar['Avatar'];
                }
                if ($getAvatar['Password'] == $pass) {
                    $dataUpdate = [
                        'Name' => $name,
                        'Avatar' => $filepath,
                        'Password' => $pass,
                        'Status' => $status,
                    ];
                    $this->userModel->update($id, $dataUpdate);
                } else {
                    $dataUpdate = [
                        'Name' => $name,
                        'Avatar' => $filepath,
                        'Password' => md5($pass),
                        'Status' => $status,
                    ];
                    $this->userModel->update($id, $dataUpdate);
                }
                return $this->respond($dataUpdate);
                // return redirect()->to('showUser');
            } else {
                return $this->fail($this->validator->getErrors());
                // $data['getUser'] = $this->userModel->getUser($iduser);
                // $data['validation'] = $this->validator;
                // return view('Admin/UpdateUserView', $data);
            }
        }
    }
    public function deleteUser($id)
    {
        $getAvatar = $this->userModel->getUser($id);
        if (strpos($getAvatar['Avatar'], 'via') != 8) {
            unlink("uploads/" . $getAvatar['Avatar']);
        }
        $check = $this->userModel->deleteUser($id);
        return $this->respond($check);
        // return redirect()->to('showUser');
    }
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            $session = \Config\Services::session();
            $session->remove('user');
            echo "logout successfully";
            // return redirect()->to('/');
        } else {
            return redirect()->to('login');
        }
    }
    public function login()
    {
        if (isset(session()->get('user')['Status']) && session()->get('user')['Status'] == 0) {
            return redirect()->to('/');
        } elseif (isset(session()->get('user')['Status']) && session()->get('user')['Status'] == 1) {
            return redirect()->to('showUser');
        } else {
            return view('Admin/LoginView');
        }
    }
    public function showInsertUser()
    {
        return view('Admin/InsertUserView');
    }
}
