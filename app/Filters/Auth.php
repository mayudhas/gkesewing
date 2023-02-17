<?php

namespace App\Filters;

use App\Helpers\CookieHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$_COOKIE[CookieHelper::$nameCookie]) {
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}
