<?php

namespace Panel\Pelanggan\Config;

use App\Models\PelangganModel;
use CodeIgniter\Config\BaseService;
use Panel\Pelanggan\Services\PelangganService;

class Services extends BaseService
{
    public static function pelangganService(): PelangganService
    {
        return new PelangganService(new PelangganModel());
    }
}