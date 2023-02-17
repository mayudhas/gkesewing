<?php

namespace Panel\Authentication\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\ResponseHelper;
use Panel\Authentication\Config\Services;

class AuthController extends CorePanelController
{
    protected $pathViews = 'Panel\Authentication\Views\\';

    public function __construct(private Services $service)
    {
    }

    public final function index(): void
    {
        echo view($this->pathViews . 'login-page');
    }

    public final function validation(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            checkCsrfToken($this->request->getPost('_token'));
            $rules = $this->validate([
                'username' => 'required|min_length[3]',
                'password' => 'required|min_length[6]'
            ]);
            if ($rules === false) throw new \Exception("Validation data failed.<br>" . implode("<br>", $this->validation->getErrors()));
            $users = $this->service->AuthService()->validationLogin($this->request);
            $response = ResponseHelper::getStatusTrue(data: $users);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response)->setStatusCode($response['statusCode']);
    }

    public final function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}