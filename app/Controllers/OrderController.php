<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\RESTful\ResourceController;

$this->session = \Config\Services::session();

class OrderController extends ResourceController
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
        return $this->respond($data);
        // return view('Admin/UserView', $data);
    }
    public function acceptOrder($id)
    {
        $data = $this->orderModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Order');
        } else {
            $check = $this->orderModel->update($id, ['Status' => 2]);
            return $this->respondUpdated($check);
            // return redirect()->to('showOrder');
        }
    }
    public function denyOrder($id)
    {
        $data = $this->orderModel->find($id);
        if (empty($data)) {
            return $this->failNotFound('Not Order');
        } else {
            $check = $this->orderModel->update($id, ['Status' => 1]);
            return $this->respondUpdated($check);
            // return redirect()->to('showOrder');
        }
    }
}
