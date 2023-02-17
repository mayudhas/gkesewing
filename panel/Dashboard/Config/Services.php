<?php

namespace Panel\Dashboard\Config;

use CodeIgniter\Config\BaseService;
use Panel\Dashboard\Services\DashboardService;

class Services extends BaseService
{
    public static function dashboardService(): DashboardService
    {
        return new DashboardService();
    }
}