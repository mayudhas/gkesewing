<?php

namespace Panel\Laporan\Config;

use App\Models\AkunModel;
use App\Models\LedgerModel;
use CodeIgniter\Config\BaseService;
use Panel\Laporan\Services\BukuBesarService;

class Service extends BaseService
{

    public static function bukuBesarService(): BukuBesarService
    {
        return new BukuBesarService(new LedgerModel(), new AkunModel());
    }

}