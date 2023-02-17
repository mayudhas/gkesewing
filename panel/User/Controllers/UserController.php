<?php

namespace Panel\User\Controllers;

use App\Controllers\CorePanelController;
use Panel\User\Config\Services;

class UserController extends CorePanelController
{

    protected $pathViews = 'Panel\User\Views\\';

    public function __construct(private Services $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Pengguna';
        $breadcrumbs = [
            [
                'title' => 'Pengguna',
                'href' => base_url('pengguna')
            ]
        ];
        $data['user_level_id'] = $this->request->getGet('user_level_id') ? (int)$this->request->getGet('user_level_id') : 1;
        $data['users'] = $this->service->userService()->fetch($this->request);
        $data['userLevels'] = $this->service->userService()->fetchUserLevelModel();
        $data['employees'] = $this->service->userService()->fetchEmployeeNotExistInUsers();
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->userService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pengguna');
    }

    public function delete($userId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->userService()->delete($userId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pengguna');
    }

    public function update($userId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->userService()->update($userId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pengguna');
    }

}