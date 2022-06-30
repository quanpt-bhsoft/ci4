<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class User_control extends BaseController
{
    public function login()
    {
        return view('Admin/Login_view');
    }
    public function check_login()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
        $model = model(GetData::class);
        $check = $model->login($email,md5($pass));
        if(count($check) != 0)
        {
            $_SESSION['user'] = $check[0];
            if($check[0]['Status'] == 1)
            {
                return redirect()->to('show_user');
            }
            else
            {
                return redirect()->to('/');
            }
        }
        else
        {
            echo "Dang Nhap That Bai";
        }
    }
    public function show_user($email = null)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetData::class);
            $get_user = $model->getuser($email);
            for($i = 0;$i < count($get_user);$i++)
                {
                    $course = $model->get_course($email);
                    if($course == false)
                    {
                        array_push($get_user[$i],' ');
                    }
                    else 
                    {
                        for($j = 0; $j< count($course);$j++)
                        {
                            array_push($get_user[$i],implode(" ",$course[$j]));
                        }
                    }
                }
            $data['getuser'] = $get_user;
            return view('Admin/User_view',$data);
        }
        else
        {
            return redirect()->to('login');
        }
    } 
    public function delete_user($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetData::class);
            $get_avatar = $model->getuser($id);
            unlink("uploads/".$get_avatar[0]['Avatar']);
            $model->delete_user($id);
            return redirect()->to('show_user');
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function insert_user()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $helpers = ['form'];
            if($this->request->getMethod() == 'post')
            {
                $name=$this->request->getPost('name');
                $email=$this->request->getPost('email');
                $pass=$this->request->getPost('pass');
                //upload anh

                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[userfile]'
                            . '|is_image[userfile]'
                            . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[userfile,100]'
                            . '|max_dims[userfile,1024,768]',
                    ],
                ];
                $img = $this->request->getFile('userfile');
                if (! $img->hasMoved())
                {
                    $filepath = $img->getRandomName();
                    $img->move('uploads/',$filepath);
                }
                //echo $filepath;
                $status=$this->request->getPost('status');
                $model = model(GetData::class);
                $model->insert_user($name,$email,md5($pass),$filepath,$status);
                return redirect()->to('show_user');
            }else
            {
                return view('Admin/Insert_user_view');
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function update_user($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $helpers = ['form'];
            if($this->request->getMethod() == 'post')
            {
                $iduser= $this->request->getPost('id');
                $name=$this->request->getPost('name');
                $email=$this->request->getPost('email');
                $pass=$this->request->getPost('pass');
                $status=$this->request->getPost('status');
                //upload anh

                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[userfile]'
                            . '|is_image[userfile]'
                            . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[userfile,240000000]'
                            . '|max_dims[userfile,2048,2048]',
                    ],
                ];
                $img = $this->request->getFile('userfile');
                $model = model(GetData::class);
                $get_avatar = $model->getuser($iduser);
                if($img != "")
                {
                    if (! $img->hasMoved())
                    {
                        $filepath = $img->getRandomName();
                        $img->move('uploads/',$filepath);
                    }
                    unlink("uploads/".$get_avatar[0]['Avatar']);
                }
                else
                {
                    $filepath = $get_avatar[0]['Avatar'];
                }
                if($get_avatar[0]['Password'] == $pass)
                {
                    $model->update_user($iduser,$name,$email,$pass,$filepath,$status);
                }
                else
                {
                    $model->update_user($iduser,$name,$email,md5($pass),$filepath,$status);
                }
                return redirect()->to('show_user');
            }
            else
            {
                $model = model(GetData::class);
                $data['getuser'] = $model->getuser($id);
                return view('Admin/Update_user_view',$data);
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function logout()
    {
        if(isset($_SESSION['user']))
        {
            $session = \Config\Services::session(); 
            $session->remove('user');
            return redirect()->to('/');
        }
        else
        {
            return redirect()->to('login');
        }
    }
}
