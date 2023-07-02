<?php

namespace Panel\Laporan\Controllers;

use App\Controllers\CorePanelController;
use App\Enums\MonthEnum;
use App\Models\UtiAccountPostModel;
use Panel\Bku\Config\Services;

class JurnalController extends CorePanelController
{

    protected $pathViews = 'Panel\Laporan\Views\jurnal\\';

    public function __construct(
        private UtiAccountPostModel             $accountPostModel,
        private Services                        $serviceBku,
        private \Panel\Rekening\Config\Services $servicesRekening
    )
    {
        $this->BukuJurnalService = $this->serviceBku->serviceBukuJurnal();
        $this->RekeningService = $this->servicesRekening->rekeningService();
    }

    public function index(): string
    {
        $data['page_title'] = 'Jurnal';
        $breadcrumbs = [
            [
                'title' => 'Jurnal',
                'href' => base_url('laporan/jurnal')
            ]
        ];
        $data['params'] = [
            'month' => $this->request->getGet('month') ?? date('m'),
            'year' => $this->request->getGet('year') ?? date('Y'),
        ];
        $data['months'] = MonthEnum::monthIndo();
        $data['posts'] = $this->accountPostModel->findAll();
        $data['accounts'] = $this->RekeningService->fetch();
        $data['ledgers'] = $this->BukuJurnalService->getLedgerDetailPeriode($data['params']['year'], $data['params']['month']);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

}