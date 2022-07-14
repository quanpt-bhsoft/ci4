<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Files\File;

$this->session = \Config\Services::session();

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }
    public function showOrder()
    {
        $data['getOrderNew'] = $this->orderModel->getOrder(0);
        $data['pagerNew'] = $this->orderModel->pager;
        $data['getOrderDeny'] = $this->orderModel->getOrder(1);
        $data['pagerDeny'] = $this->orderModel->pager;
        $data['getOrderAccept'] = $this->orderModel->getOrder(2);
        $data['pagerAccept'] = $this->orderModel->pager;
        //var_dump($data['get_order_new']);
        return view('Admin/UserView', $data);
    }
    public function acceptOrder($idorder)
    {
        $this->orderModel->update($idorder, 2);
        return redirect()->to('showOrder');
    }
    public function denyOrder($idorder)
    {
        $this->orderModel->update($idorder, 1);
        return redirect()->to('showOrder');
    }
}
