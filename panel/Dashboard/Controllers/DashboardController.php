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
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

}