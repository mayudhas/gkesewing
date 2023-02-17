<?php

namespace Panel\User\Config;

use App\Models\KaryawanModel;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use Panel\User\Services\UserService;

class Services extends BaseService
{

    public static function userService(): UserService
    {
        return new UserService(new UserModel(), new UserLevelModel(), new KaryawanModel());
    }

}