<?php

namespace Panel\Pembatalan\Config;


use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use CodeIgniter\Config\BaseService;
use Panel\Pembatalan\Services\PenjualanService;

class Services extends BaseService
{
    public static function servicePenjualan(): PenjualanService
    {
        return new PenjualanService(
            new TransactionModel(),
            new TransactionDetailModel(),
        );
    }

}