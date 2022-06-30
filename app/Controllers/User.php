<?php

namespace App\Controllers;

use App\Models\GetDataCourse;
use App\Models\GetDataOrder;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session(); 

class User extends BaseController
{
    public function user()
    {
        $model = model(GetDataCourse::class);

        $get_course = $model->get_course(null);

        $model1 = model(GetDataOrder::class);
        if(isset($_SESSION['user']))
        {
            for($i = 0;$i < count($get_course);$i++)
                {
                    $course = $model1->get_accept($_SESSION['user']['ID'],$get_course[$i]['ID']);
                    foreach($course as $course):
                        if($course['id'] == 0)
                        {
                            array_push($get_course[$i],0);
                        }
                        else 
                        {
                            array_push($get_course[$i],1);
                        }
                    endforeach;
                }
        }
        $data['get_course'] = $get_course;
        return view('home',$data);
    }
    public function update_user($id)
    {
        $helpers = ['form'];
        if($this->request->getMethod() == 'post')
        {
            $name=$this->request->getPost('name');
            $email=$this->request->getPost('email');
            $pass=$this->request->getPost('pass');
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
            $model = model(GetData::class);
            $get_avatar = $model->getuser($id);
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
                $model->update_user($id,$name,$email,$pass,$filepath,0);
            }
            else
            {
                $model->update_user($id,$name,$email,md5($pass),$filepath,0);
            }
            return redirect()->to('/');
        }
        else
        {
            $model = model(GetData::class);
            $data['get_user'] = $model->getuser($id);
            return view('User/Home',$data);
        }
    }
    public function detail_course($id)
    {
        $model = model(GetDataCourse::class);
        $get_course = $model->get_course($id);

        $model1 = model(GetDataOrder::class);
        
        $data['get_lesson']= $model1->get_lesson($id);

        $model1 = model(GetDataOrder::class);
        if(isset($_SESSION['user'])){
            for($i = 0;$i < count($get_course);$i++)
                {
                    $course = $model1->get_accept($_SESSION['user']['ID'],$get_course[$i]['ID']);
                    foreach($course as $course):
                        if($course['id'] == 0)
                        {
                            array_push($get_course[$i],0);
                        }
                        else 
                        {
                            array_push($get_course[$i],1);
                        }
                    endforeach;
                }
        }
        $data['get_course'] = $get_course;

        return view('User/detail_course',$data);
    }
    public function cart()
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'];
        }
        return view('User/cart');
    }
    public function add_cart($id)
    {
        $model = model(GetDataCourse::class);
        $get_course = $model->get_course($id);
        //var_dump($_SESSION['cart']);

        if(count($_SESSION['cart']) == 0)
        {
            array_push($_SESSION['cart'],$get_course[0]);
            return redirect()->to('cart');
        }
        else
        {
            for($i = 0; $i<count($_SESSION['cart']);$i++)
            {
                if($_SESSION['cart'][$i]['ID']!=$id)
                {
                    array_push($_SESSION['cart'],$get_course[0]);
                    return redirect()->to('cart');
                }
                else
                {
                    echo 'The course is already in your cart';
                }
            }
        }   
    }
    public function delete_cart($id)
    {
        for($i = 0; $i<count($_SESSION['cart']);$i++)
        {
            if($_SESSION['cart'][$i]['ID']==$id)
            {
                array_splice($_SESSION['cart'],$i,1);
            }
        }
        return redirect()->to('cart');
    }
    public function add_order($idcourse)
    {
        if(isset($_SESSION['user']))
        {
            if(count($_SESSION['cart']) != 0)
            {
                //echo $_SESSION['user']['ID'];
                $model = model(GetDataOrder::class);
                $check_order = $model->check_order($idcourse,$_SESSION['user']['ID']);
                if(isset($check_order) && $check_order[0]['amount'] == 0 )
                {
                    $model->insert_order($_SESSION['user']['ID'],$idcourse);
                    return redirect()->to('delete_cart/'.$idcourse);                    
                }
                else
                {
                    return redirect()->to('delete_cart/'.$idcourse);
                }

            }
        }
        else
        {
           return redirect()->to('login');
        }
    }
    public function history_order($iduser)
    {
        $model = model(GetDataOrder::class);
        $data['get_order'] = $model->history_order($iduser);
        return view('User/history_order',$data);
    }
}