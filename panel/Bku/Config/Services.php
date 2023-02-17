<?php

namespace Panel\Bku\Config;

use App\Models\LedgerDetailModel;
use App\Models\LedgerDetailTempModel;
use App\Models\LedgerModel;
use App\Models\PengeluaranModel;
use App\Models\TransactionModel;
use CodeIgniter\Config\BaseService;
use Panel\Bku\Services\BukuJurnalService;

class Services extends BaseService
{
    public static function serviceBukuJurnal(): BukuJurnalService
    {
        return new BukuJurnalService(
            new LedgerModel(),
            new LedgerDetailModel(),
            new TransactionModel(),
            new PengeluaranModel()
        );
    }
}