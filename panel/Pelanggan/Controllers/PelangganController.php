<?php

namespace Panel\Pelanggan\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\ResponseHelper;
use Panel\Pelanggan\Config\Services;

class PelangganController extends CorePanelController
{
    protected $pathViews = 'Panel\Pelanggan\Views\\';
    private \Panel\Pelanggan\Services\PelangganService $PelangganService;

    public function __construct(private Services $service)
    {
        $this->PelangganService = $this->service->pelangganService();
    }

    public function index(): string
    {
        $data['page_title'] = 'Pelanggan';
        $breadcrumbs = [
            [
                'title' => 'Pelanggan',
                'href' => base_url('pelanggan')
            ]
        ];
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        $data['customers'] = $this->service->pelangganService()->fetch($this->request);
        return $this->render('index', $data);
    }

    public final function loadPelanggan(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $data = $this->PelangganService->firstPhone($this->request->getGet('phone'));
            $response = ResponseHelper::getStatusTrue(data: $data);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pelangganService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pelanggan');
    }

    public function delete($customerId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pelangganService()->delete($customerId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pelanggan');
    }

    public function update($customerId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->pelangganService()->update($customerId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/pelanggan');
    }

}