<?php

namespace Panel\Pemasok\Controllers;

use App\Controllers\CorePanelController;
use Panel\Pemasok\Config\Services;

class PemasokController extends CorePanelController
{
    protected $pathViews = 'Panel\Pemasok\Views\\';

    public function __construct(private Services $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Pemasok';
        $breadcrumbs = [
            [
                'title' => 'Pemasok',
                'href' => base_url('pemasok')
            ]
        ];
        $data['suppliers'] = $this->service->pemasokService()->fetch($this->request);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pemasokService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pemasok');
    }

    public function delete($supplierId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pemasokService()->delete($supplierId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pemasok');
    }

    public function update($supplierId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pemasokService()->update($supplierId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pemasok');
    }
}