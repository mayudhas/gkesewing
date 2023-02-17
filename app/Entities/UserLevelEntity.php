<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserLevelEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'user_level_id' => 'integer',
        'user_level_name' => 'string',
    ];
}
