<?php

namespace Panel\Authentication\Config;

use App\Models\UserModel;
use CodeIgniter\Config\BaseService;
use Panel\Authentication\Services\AuthService;

class Services extends BaseService
{
    public final function AuthService(): AuthService
    {
        return new AuthService(new UserModel());
    }
}