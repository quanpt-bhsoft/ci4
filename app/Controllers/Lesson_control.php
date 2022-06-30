<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class Lesson_control extends BaseController
{
    public function show_lesson()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetDataLesson::class);
            $data['get_lesson'] = $model->get_lesson(null);
            return view('Admin/User_view',$data);
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function delete_lesson($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetDataLesson::class);
            $model->delete_lesson($id);
            return redirect()->to('show_lesson');
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function update_lesson($id)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetDataLesson::class);
            if($this->request->getMethod() == 'post')
            {
                $idlesson= $this->request->getPost('id');
                $title=$this->request->getPost('title');
                $content=$this->request->getPost('content');
                $model->update_lesson($idlesson,$title,$content);
                return redirect()->to('show_lesson');
            }
            else
            {
                
                $data['get_lesson'] = $model->get_lesson($id);
                return view('Admin/Update_lesson_view',$data);
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function insert_lesson()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1)
        {
            $model = model(GetDataLesson::class);
            if($this->request->getMethod() == 'post')
            {
                $title=$this->request->getPost('title');
                $content=$this->request->getPost('content');
                $idcourse = $this->request->getPost('course');
                $model->insert_lesson($idcourse,$title,$content);
                return redirect()->to('show_lesson');
            }
            else
            {
                $model1 = model(GetDataCourse::class);
                $data['get_course'] = $model1->get_course(null);
                return view('Admin/Insert_lesson_view',$data);
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }
}