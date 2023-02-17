<?php

namespace Panel\Transaksi\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\ResponseHelper;
use Panel\Transaksi\Config\Services;
use Panel\Transaksi\Services\PengeluaranService;

class PengeluaranController extends CorePanelController
{

    protected $pathViews = 'Panel\Transaksi\Views\pengeluaran\\';
    private PengeluaranService $PengeluaranService;

    public function __construct(private Services $service)
    {
        $this->PengeluaranService = $this->service->servicePengeluaran();
    }

    public function index(): string
    {
        $data['page_title'] = 'Pengeluaran';
        $breadcrumbs = [
            [
                'title' => 'Pengeluaran',
                'href' => base_url('pengeluaran')
            ]
        ];
        $data['spendings'] = $this->service->servicePengeluaran()->fetch($this->request);
        $data['suppliers'] = $this->service->servicePengeluaran()->fetchSuppliers($this->request);
        $data['employees'] = $this->service->servicePengeluaran()->fetchEmployees($this->request);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public final function loadPengeluaranNoLedger(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $data = $this->PengeluaranService->fetchNoLedger();
            $response = ResponseHelper::getStatusTrue(data: $data);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->servicePengeluaran()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
            echo json_encode($exception->getMessage());
            die;
        }
        return redirect()->to('/transaksi/pengeluaran');
    }

    public function delete($spendingId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->servicePengeluaran()->delete($spendingId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/transaksi/pengeluaran');
    }

    public function update($spendingId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->servicePengeluaran()->update($spendingId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/transaksi/pengeluaran');
    }

}