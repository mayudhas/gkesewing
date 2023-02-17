<?php

namespace Panel\Karyawan\Config;

use App\Models\KaryawanModel;
use CodeIgniter\Config\BaseService;
use Panel\Karyawan\Services\KaryawanService;

class Services extends BaseService
{
    public static function karyawanService(): KaryawanService
    {
        return new KaryawanService(new KaryawanModel());
    }
}