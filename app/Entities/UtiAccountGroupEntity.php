<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UtiAccountGroupEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'uti_account_group_id' => '?integer',
        'uti_account_group_name' => 'string',
        'uti_account_group_alias' => 'string'
    ];
}
