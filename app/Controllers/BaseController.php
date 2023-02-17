<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;
use CodeIgniter\View\View;
use Config\Services;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    public View $view;
    protected $request;
    protected Validation $validation;
    protected Session $session;
    protected $helpers = ['session', 'form', 'cookie', 'text', 'encryption', 'alert', 'global'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->validation = Services::validation();
        $this->session = Services::session();
        $this->view = Services::renderer();
    }
}
