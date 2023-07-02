<?php

namespace Panel\Dashboard\Controllers;

use App\Controllers\CorePanelController;
use Panel\Dashboard\Config\Services;
use Panel\Dashboard\Services\DashboardService;

class DashboardController extends CorePanelController
{
    protected $pathViews = 'Panel\Dashboard\Views\\';
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = Services::dashboardService();
    }

    public function index(): string
    {
        $data['page_title'] = 'Dashboard';
        $breadcrumbs = [
            [
                'title' => 'Dashboard',
                'href' => base_url('dashboard'),
            ],
            [
                'title' => 'Dashboard',
            ],
        ];
        $data['params'] = [
            'year' => $this->request->getGet('year') ?? date('Y'),
        ];
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public function getIncomeOutcome()
    {
        $tahun = $this->request->getGet('year') ?: date('Y');
        $income = $this->dashboardService->getIncome($tahun);
        $outcome = $this->dashboardService->getOutcome($tahun);
        $bulan = [
            1 => 0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ];
        $newIncome = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($bulan as $iBulan => $valBulan)
            foreach ($income as $valIncome)
                if ($iBulan == $valIncome->bulan)
                    $newIncome[$iBulan - 1] = doubleval($valIncome->total);
        $newOutcome = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($bulan as $iBulan => $valBulan)
            foreach ($outcome as $valOutcome)
                if ($iBulan == $valOutcome->bulan)
                    $newOutcome[$iBulan - 1] = doubleval($valOutcome->total);
        echo json_encode([
            'income' => $newIncome,
            'outcome' => $newOutcome,
        ]);
    }

}