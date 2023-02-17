<?php

namespace App\Entities;

use App\Models\UserLevelModel;
use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'user_id' => '?integer',
        'user_level_id' => 'integer',
        'user_username' => 'string',
        'user_password' => 'string',
        'user_name' => 'string',
        'user_is_active' => 'integer',
        'employee_id' => 'integer|null'
    ];

    protected $attributes = [
        'user_level' => []
    ];

    public function getUserLevel(): array|object
    {
        $this->attributes['user_level'] = (new UserLevelModel())->find($this->attributes['user_level_id']);
        return $this->attributes['user_level'];
    }

    public function setUserPassword(string $pass): self
    {
        $this->attributes['user_password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }
}
