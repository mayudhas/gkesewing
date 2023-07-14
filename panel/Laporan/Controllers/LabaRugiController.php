<?php

namespace Panel\Laporan\Controllers;

use App\Controllers\CorePanelController;
use App\Enums\MonthEnum;
use App\Models\UtiAccountPostModel;
use Panel\Bku\Config\Services;

class LabaRugiController extends CorePanelController
{

    protected $pathViews = 'Panel\Laporan\Views\laba-rugi\\';
    private \Panel\Bku\Services\BukuJurnalService $BukuJurnalService;

    public function __construct(
        private readonly Services                        $serviceBku,
        private readonly \Panel\Rekening\Config\Services $servicesRekening
    )
    {
        $this->BukuJurnalService = $this->serviceBku->serviceBukuJurnal();
    }

    public function index(): string
    {
        $data['page_title'] = 'Laba Rugi';
        $breadcrumbs = [
            [
                'title' => 'Laba Rugi',
                'href' => base_url('laporan/laba-rugi')
            ]
        ];
        $data['params'] = [
            'month' => $this->request->getGet('month') ?? date('m'),
            'year' => $this->request->getGet('year') ?? date('Y'),
        ];
        $data['months'] = MonthEnum::monthIndo();
        $data['pendapatans'] = $this->BukuJurnalService->getLedgerLabaRugi($data['params']['year'], $data['params']['month'], 4);
        $data['bebans'] = $this->BukuJurnalService->getLedgerLabaRugi($data['params']['year'], $data['params']['month'], 5);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

}