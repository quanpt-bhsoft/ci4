<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

$this->session = \Config\Services::session(); 

class Order_control extends BaseController
{
    public function show_order()
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $model = model(GetDataOrder::class);
            $data['get_order_new'] = $model->get_order(0);
            $data['get_order_deny'] = $model->get_order(1);
            $data['get_order_accept'] = $model->get_order(2);
            return view('Admin/User_view',$data);
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function accept_order($idorder)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $model = model(GetDataOrder::class);
            $model->update_order($idorder,2);
            return redirect()->to('show_order');
        }
        else
        {
            return redirect()->to('login');
        }
    }
    public function deny_order($idorder)
    {
        if(isset($_SESSION['user']) && $_SESSION['user']['Status'] == 1){
            $model = model(GetDataOrder::class);
            $model->update_order($idorder,1);
            return redirect()->to('show_order');
        }
        else
        {
            return redirect()->to('login');
        }
    }
}