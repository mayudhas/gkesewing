<?php

namespace Panel\Produk\Config;

use App\Models\ProdukModel;
use App\Models\UtiProductCategoryModel;
use CodeIgniter\Config\BaseService;
use Panel\Produk\Services\ProdukService;

class Services extends BaseService
{

    public static function produkService(): ProdukService
    {
        return new ProdukService(new ProdukModel(), new UtiProductCategoryModel());
    }

}