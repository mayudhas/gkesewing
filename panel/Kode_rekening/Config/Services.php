<?php

namespace Panel\Kode_rekening\Config;

use App\Models\AkunModel;
use App\Models\UtiAccountGroupModel;
use App\Models\UtiAccountPostModel;
use CodeIgniter\Config\BaseService;
use Panel\Kode_rekening\Services\KodeRekeningService;

class Services extends BaseService
{

    public static function kodeRekeningService(): KodeRekeningService
    {
        return new KodeRekeningService(new AkunModel(), new UtiAccountPostModel(), new UtiAccountGroupModel());
    }

}