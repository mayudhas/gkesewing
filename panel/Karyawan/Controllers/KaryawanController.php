<?php

namespace Panel\Karyawan\Controllers;

use App\Controllers\CorePanelController;
use Panel\Karyawan\Config\Services;

class KaryawanController extends CorePanelController
{
    protected $pathViews = 'Panel\Karyawan\Views\\';

    public function __construct(private Services $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Karyawan';
        $breadcrumbs = [
            [
                'title' => 'Karyawan',
                'href' => base_url('karyawan')
            ]
        ];
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        $data['employees'] = $this->service->karyawanService()->fetch($this->request);
        return $this->render('index', $data);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->karyawanService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/karyawan');
    }

    public function delete($employeeId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->karyawanService()->delete($employeeId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/karyawan');
    }

    public function update($employeeId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->karyawanService()->update($employeeId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/karyawan');
    }

}