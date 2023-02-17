<?php

namespace App\Filters;

use App\Helpers\CookieHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Administrator implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$_COOKIE['CookieHelper::$nameCookie']) {
            return redirect()->to('/');
        }
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        } else {
            $log = CookieHelper::getCookie();
            if ((int)$log['level_id'] !== 1) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            };
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }

}
