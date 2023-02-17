<?php

namespace Panel\Kode_rekening\Controllers;

use App\Controllers\CorePanelController;
use Panel\Kode_rekening\Config\Services;

class KodeRekeningController extends CorePanelController
{


    protected $pathViews = 'Panel\Kode_rekening\Views\\';

    public function __construct(private Services $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Kode Rekening';
        $breadcrumbs = [
            [
                'title' => 'Kode Rekening',
                'href' => base_url('kode-rekening')
            ]
        ];
        $data['accountCodes'] = $this->service->kodeRekeningService()->fetch($this->request);
        $data['utiAccountPosts'] = $this->service->kodeRekeningService()->fetchUtiAccountPost();
        $data['utiAccountGroups'] = $this->service->kodeRekeningService()->fetchUtiAccountGroup();
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->kodeRekeningService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/kode-rekening');
    }

    public function delete($productId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->kodeRekeningService()->delete($productId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/kode-rekening');
    }

    public function update($productId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->kodeRekeningService()->update($productId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/kode-rekening');
    }

}