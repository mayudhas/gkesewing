<?php

namespace Panel\Pembatalan\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\ResponseHelper;
use Panel\Pembatalan\Config\Services;

class PenjualanController extends CorePanelController
{
    protected $pathViews = 'Panel\Pembatalan\Views\\';
    private \Panel\Pembatalan\Services\PenjualanService $servicePenjualan;

    public function __construct(
        private Services $services
    )
    {
        $this->servicePenjualan = $this->services->servicePenjualan();
    }

    public final function index(): string
    {
        $breadcrumbs = [
            ['title' => 'Pembatalan', 'href' => '#'],
            ['title' => 'Penjualan', 'href' => '#'],
        ];
        $data['code'] = $this->request->getGet('code');
        $data['page_title'] = 'Transaksi';
        if ($data['code']) {
            $data['transaction'] = $this->servicePenjualan->findPenjualanCode($data['code']);
            $data['transactionDetails'] = $this->servicePenjualan->getPenjualanDetailCode($data['code']);
        }
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('penjualan/index', $data);
    }

    public final function cancel(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $this->servicePenjualan->cancelTransaction($this->request);
            $response = ResponseHelper::getStatusTrue();
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response);

    }

}