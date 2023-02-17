<?php

namespace Panel\Rekening\Config;

use App\Models\AkunModel;
use CodeIgniter\Config\BaseService;
use Panel\Rekening\Services\RekeningService;

class Services extends BaseService
{
    public static function rekeningService(): RekeningService
    {
        return new RekeningService(new AkunModel());
    }
}