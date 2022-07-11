<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class OrderControl extends BaseController
{
    public function showOrder()
    {
        $model = model(OrderModel::class);
        $data['get_order_new'] = $model->getOrder(0);
        $data['get_order_deny'] = $model->getOrder(1);
        $data['get_order_accept'] = $model->getOrder(2);
        //var_dump($data['get_order_new']);
        return view('Admin/UserView', $data);
    }
    public function acceptOrder($idorder)
    {
        $model = new OrderModel();
        $model->update($idorder, 2);
        return redirect()->to('showOrder');
    }
    public function denyOrder($idorder)
    {
        $model = new OrderModel;
        $model->update($idorder, 1);
        return redirect()->to('showOrder');
    }
}
