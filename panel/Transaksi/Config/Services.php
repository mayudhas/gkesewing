<?php

namespace Panel\Transaksi\Config;

use App\Models\KaryawanModel;
use App\Models\PelangganModel;
use App\Models\PemasokModel;
use App\Models\PengeluaranModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionDetailTempModel;
use App\Models\TransactionModel;
use CodeIgniter\Config\BaseService;
use Panel\Transaksi\Services\PengeluaranService;
use Panel\Transaksi\Services\PenjualanService;

class Services extends BaseService
{
    public static function servicePenjualan(): PenjualanService
    {
        return new PenjualanService(
            new TransactionModel(),
            new TransactionDetailModel(),
            new TransactionDetailTempModel(),
            new PelangganModel(),
            new \Panel\Produk\Config\Services()
        );
    }

    public static function servicePengeluaran(): PengeluaranService
    {
        return new PengeluaranService(new PengeluaranModel(), new PemasokModel(), new KaryawanModel());
    }
}