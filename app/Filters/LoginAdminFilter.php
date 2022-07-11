<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

$this->session = \Config\Services::session();

class LoginAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        if (!session()->has('user')) {
            return redirect()->to('login');
        } elseif (session()->get('user')['Status'] == 0) {
            echo 'Đây là trang của admin, Mời đăng nhập với quyền admin';
            exit();
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        //
    }
}
