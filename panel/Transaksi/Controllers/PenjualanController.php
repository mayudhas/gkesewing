<?php

namespace Panel\Transaksi\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\CookieHelper;
use App\Helpers\ResponseHelper;

class PenjualanController extends CorePanelController
{
    protected $pathViews = 'Panel\Transaksi\Views\\';
    private \Panel\Produk\Services\ProdukService $ProdukService;
    private \Panel\Karyawan\Services\KaryawanService $KaryawanService;
    private \Panel\Transaksi\Services\PenjualanService $PenjualanService;

    public function __construct(
        private \Panel\Produk\Config\Services    $servicesProduct,
        private \Panel\Transaksi\Config\Services $servicesTransaksi,
        private \Panel\Karyawan\Config\Services  $servicesKaryawan
    )

    {
        $this->ProdukService = $this->servicesProduct->produkService();
        $this->PenjualanService = $this->servicesTransaksi->servicePenjualan();
        $this->KaryawanService = $this->servicesKaryawan->karyawanService();
    }

    public function index()
    {
        if ($this->request->getGet('reset') == true) {
            delete_cookie(CookieHelper::$transaction);
            $this->PenjualanService->resetTransaction();
        }
        $breadcrumbs = [
            ['title' => 'Penjualan', 'href' => '#']
        ];
        $dateStart = $this->request->getGet('start') ?? date('Y-m-d');
        $dateEnd = $this->request->getGet('end') ?? date('Y-m-d');

        $data['page_title'] = 'Transaksi';
        $data['date_start'] = $dateStart;
        $data['date_end'] = $dateEnd;
        $data['transactions'] = $this->PenjualanService->fetchDate($dateStart, $dateEnd);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('penjualan/index', $data);
    }

    public final function detail(): string
    {
        CookieHelper::setCodeTransaction();
        $data['page_title'] = 'Transaksi';
        $breadcrumbs = [
            ['title' => 'Penjualan', 'href' => base_url('transaksi/penjualan')],
            ['title' => 'Detail ', 'href' => '#']
        ];
        $data['detailsTemp'] = $this->PenjualanService->getTransactionDetailTemp(['transaction_code' => get_cookie(CookieHelper::$transaction)])->findAll();
        $data['products'] = $this->ProdukService->fetchJoinCategory();
        $data['employees'] = $this->KaryawanService->fetch($this->request);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('penjualan/detail', $data);
    }

    public final function store()
    {
        try {
            checkCsrfToken($this->request->getPost('_token'));
            $response = $this->PenjualanService->transactionStore($this->request);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        if ($response['status']) {
            setAlert('Berhasil menambah data !');
            return redirect()->to('transaksi/penjualan?reset=true');
        } else {
            setAlert($response['message'], 'error');
            return redirect()->back();
        }
    }

    public final function loadPenjualanNoLedger(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $data = $this->PenjualanService->fetchNoLedger();
            $response = ResponseHelper::getStatusTrue(data: $data);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }


    public final function temporaryStore(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            checkCsrfToken($this->request->getPost('_token'));
            $this->PenjualanService->temporaryStore($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->back();
    }

    public final function temporaryDelete(int $id): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $this->PenjualanService->temporaryDelete($id);
            $response = ResponseHelper::getStatusTrue();
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }


}