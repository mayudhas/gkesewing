<?php

namespace Panel\Pemasok\Config;

use App\Models\PemasokModel;
use CodeIgniter\Config\BaseService;
use Panel\Pemasok\Services\PemasokService;

class Services extends BaseService
{

    public static function pemasokService(): PemasokService
    {
        return new PemasokService(new PemasokModel());
    }

}