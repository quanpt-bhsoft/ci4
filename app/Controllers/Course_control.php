<?php

namespace App\Controllers;

use App\Models\GetDataCourse;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session(); 

class Course_control extends BaseController
{
    public function show_course($id = null)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $model = model(GetDataCourse::class);
            $get_course = $model->get_course($id);
            $data['get_course'] = $get_course;
            return view('Admin/User_view',$data);
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function delete_course($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $model = model(GetDataCourse::class);
            $get_course = $model->get_course($id);
            unlink("uploads/".$get_course[0]['Avatar']);
            $model->delete_course($id);
            return redirect()->to('show_course');
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function insert_course()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $helpers = ['form'];
            if($this->request->getMethod() == 'post')
            {
                $name=$this->request->getPost('name');
                $price=$this->request->getPost('price');
                $title=$this->request->getPost('title');
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
                $describe=$this->request->getPost('describe');
                $model = model(GetDataCourse::class);
                $model->insert_course($name,$price,$filepath,$title,$describe);
                return redirect()->to('show_course');
            }
            else
            {
            return view('Admin/Insert_course_view');
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function update_course($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $helpers = ['form'];
            if($this->request->getMethod() == 'post')
            {
                $idcourse= $this->request->getPost('id');
                $name=$this->request->getPost('name');
                $price=$this->request->getPost('price');
                $title=$this->request->getPost('title');
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
                if (! $img->hasMoved())
                {
                    $filepath = $img->getRandomName();
                    $img->move('uploads/',$filepath);
                }
                //echo $filepath;
                $describe=$this->request->getPost('describe');
                $model = model(GetDataCourse::class);
                $get_course = $model->get_course($idcourse);
                unlink("uploads/".$get_course[0]['Avatar']);
                $model->update_user($idcourse,$name,$price,$filepath,$title,$describe);
                return redirect()->to('show_course');
            }
            else
            {
                $model = model(GetDataCourse::class);
                $data['getcourse'] = $model->get_course($id);
                return view('Admin/Update_course_view',$data);
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
}