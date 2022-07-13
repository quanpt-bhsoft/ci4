<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class OrderController extends BaseController
{
    public function showOrder()
    {
        $model = new OrderModel();
        $data['getOrderNew'] = $model->getOrder(0);
        $data['pagerNew'] = $model->pager;
        $data['getOrderDeny'] = $model->getOrder(1);
        $data['pagerDeny'] = $model->pager;
        $data['getOrderAccept'] = $model->getOrder(2);
        $data['pagerAccept'] = $model->pager;
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
