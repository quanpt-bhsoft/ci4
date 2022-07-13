<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Files\File;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

$this->session = \Config\Services::session();

class UserController extends ResourceController
{
    protected $table = 'user';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['Name', 'Email', 'Avatar', 'Password', 'Status'];
    public function index()
    {
        $model = new UserModel();
        $data['user'] = $model->paginate(2);
        $data['pager'] = $model->pager;
        return $this->respond($data);
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
            $model = new UserModel();
            $check = $model->login($email, md5($pass));
            if (isset($check)) {
                $_SESSION['user'] = $check;
                if ($check['Status'] == 1) {
                    return redirect()->to('showUser');
                } else {
                    return redirect()->to('/');
                }
            } else {
                echo "Dang Nhap That Bai";
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('LoginView', $data);
        }
    }
    public function showUser($email = null)
    {
        $model = new UserModel();
        $getUser = $model->getUser($email);
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
        $data['pager'] = $model->pager;
        return view('Admin/UserView', $data);
    }
    public function deleteUser($id)
    {
        $model = model(UserModel::class);
        $getAvatar = $model->getUser($id);
        if (strpos($getAvatar['Avatar'], 'via') != 8) {
            unlink("uploads/" . $getAvatar['Avatar']);
        }
        $model->deleteUser($id);
        return redirect()->to('showUser');
    }
    public function showInsertUser()
    {
        return view('Admin/InsertUserView');
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
            $model = new UserModel();
            //var_dump($data);
            $model->insertUser($data);
            return redirect()->to('showUser');
        } else {
            $data['validation'] = $this->validator;
            return view('Admin/InsertUserView', $data);
        }
    }
    public function updateUser($id)
    {
        $helpers = ['form'];
        if ($this->request->getMethod() == 'post') {
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
            $iduser = $this->request->getPost('id');
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $pass = $this->request->getPost('pass');
            $status = $this->request->getPost('status');
            //upload anh
            $img = $this->request->getFile('userfile');
            if ($this->validate($rules)) {

                $model = model(UserModel::class);
                $getAvatar = $model->getUser($iduser);
                if ($img != "") {
                    if (!$img->hasMoved()) {
                        $filepath = $img->getRandomName();
                        $img->move('uploads/', $filepath);
                    }
                    if (strpos($getAvatar['Avatar'], 'via') != 8) {
                        unlink("uploads/" . $getAvatar['Avatar']);
                    }
                } else {
                    $filepath = $getAvatar['Avatar'];
                }
                if ($getAvatar['Password'] == $pass) {
                    $data = [
                        'Name' => $name,
                        'Email' => $email,
                        'Avatar' => $filepath,
                        'Password' => $pass,
                        'Status' => $status,
                    ];
                    $model->update($iduser, $data);
                } else {
                    $data = [
                        'Name' => $name,
                        'Email' => $email,
                        'Avatar' => $filepath,
                        'Password' => md5($pass),
                        'Status' => $status,
                    ];
                    $model->update($iduser, $data);
                }
                return redirect()->to('showUser');
            } else {
                $model = new UserModel();
                $data['getUser'] = $model->getUser($iduser);
                $data['validation'] = $this->validator;
                return view('Admin/UpdateUserView', $data);
            }
        } else {

            $model = new UserModel();
            $data['getUser'] = $model->getUser($id);
            return view('Admin/UpdateUserView', $data);
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            $session = \Config\Services::session();
            $session->remove('user');
            return redirect()->to('/');
        } else {
            return redirect()->to('login');
        }
    }
}
